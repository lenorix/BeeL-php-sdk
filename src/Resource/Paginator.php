<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

/**
 * Lazily yields the items of BeeL's paginated lists, fetching each page when iteration reaches it.
 *
 * @internal
 */
final class Paginator
{
    /**
     * Lazily yield every item of a page-numbered list, fetching each page when it is reached.
     *
     * Starts at `$query['page']` (default 1) and keeps the other query options,
     * including `limit`, for every page.
     *
     * @template TPage of object
     * @template TItem
     *
     * @param  callable(array<string, mixed>): TPage  $fetchPage  Fetches one page for a query.
     * @param  callable(TPage): list<TItem>  $items  Returns the items of a fetched page.
     * @param  array<string, mixed>  $query
     * @return \Generator<int, TItem>
     */
    public static function pages(callable $fetchPage, callable $items, array $query): \Generator
    {
        $page = max(1, (int) ($query['page'] ?? 1));

        while (true) {
            $response = $fetchPage([...$query, 'page' => $page]);
            $batch = $items($response);
            foreach ($batch as $item) {
                yield $item;
            }

            $reportedPage = self::reportedPage($response);
            if ($batch === [] || ! self::hasNextPage($response) || ($reportedPage !== null && $reportedPage !== $page)) {
                return;
            }
            $page++;
        }
    }

    /**
     * Lazily yield every item of a cursor-paginated list.
     *
     * @template TPage of object
     * @template TItem
     *
     * @param  callable(array<string, mixed>): TPage  $fetchPage  Fetches one page for a query.
     * @param  callable(TPage): list<TItem>  $items  Returns the items of a fetched page.
     * @param  callable(TPage): ?string  $nextCursor  Returns the cursor of the next page, or null on the last one.
     * @param  array<string, mixed>  $query
     * @return \Generator<int, TItem>
     */
    public static function cursors(callable $fetchPage, callable $items, callable $nextCursor, array $query): \Generator
    {
        // Every cursor already read, so a cycle such as A, B, A ends instead of repeating pages forever.
        $seen = isset($query['cursor']) ? [(string) $query['cursor'] => true] : [];
        while (true) {
            $response = $fetchPage($query);
            $batch = $items($response);
            foreach ($batch as $item) {
                yield $item;
            }

            $cursor = $nextCursor($response);
            if ($batch === [] || $cursor === null || $cursor === '' || isset($seen[$cursor])) {
                return;
            }
            $seen[$cursor] = true;
            $query['cursor'] = $cursor;
        }
    }

    /** The pagination model of a page, when BeeL sent one. */
    private static function pagination(object $response): ?object
    {
        if (! method_exists($response, 'isInitialized') || ! method_exists($response, 'getPagination') || ! $response->isInitialized('pagination')) {
            return null;
        }
        $pagination = $response->getPagination();

        return is_object($pagination) && method_exists($pagination, 'isInitialized') ? $pagination : null;
    }

    /**
     * The page number BeeL says it answered, or null when it does not say.
     *
     * A server that ignored `page` would keep answering the same page with `has_next`;
     * comparing the two stops the iteration instead of looping forever.
     */
    private static function reportedPage(object $response): ?int
    {
        $pagination = self::pagination($response);

        return $pagination !== null && method_exists($pagination, 'getCurrentPage') && $pagination->isInitialized('currentPage')
            ? (int) $pagination->getCurrentPage() : null;
    }

    /**
     * Read `has_next`, which BeeL may omit, and fall back to comparing page numbers.
     */
    private static function hasNextPage(object $response): bool
    {
        $pagination = self::pagination($response);
        if ($pagination === null) {
            return false;
        }
        // `has_next` is nullable in BeeL's contract: only a boolean decides, null falls back to page numbers.
        if ($pagination->isInitialized('hasNext') && method_exists($pagination, 'getHasNext') && $pagination->getHasNext() !== null) {
            return $pagination->getHasNext();
        }
        if ($pagination->isInitialized('currentPage') && $pagination->isInitialized('totalPages')
            && method_exists($pagination, 'getCurrentPage') && method_exists($pagination, 'getTotalPages')) {
            return $pagination->getCurrentPage() < $pagination->getTotalPages();
        }

        return false;
    }
}

<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1ConfigurationSeriesGetResponse200DataPagination implements AdditionalPropertiesInterface
{
    use AdditionalAndPatternProperties;
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * @var int
     */
    protected $currentPage;
    /**
     * How many pages the query has. An empty collection has **one** page — the
     * first one, empty — so the smallest value a canonical route returns is `1`.
     * 
     * The deprecated flat aliases (`/v1/invoices`, `/v1/customers`, …) answer `0`
     * for that same empty collection, and `has_next`/`has_previous` follow suit.
     * They were left as they were on purpose: a client that reads `total_pages == 0`
     * as "no results" would break if it changed under it. Do not compare the two
     * families of routes field by field; read `total_items` if what you want to know
     * is whether anything came back.
     * 
     *
     * @var int
     */
    protected $totalPages;
    /**
     * @var int
     */
    protected $totalItems;
    /**
     * @var int
     */
    protected $itemsPerPage;
    /**
     * @var bool
     */
    protected $hasNext;
    /**
     * @var bool
     */
    protected $hasPrevious;
    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }
    /**
     * @param int $currentPage
     *
     * @return self
     */
    public function setCurrentPage(int $currentPage): self
    {
        $this->initialized['currentPage'] = true;
        $this->currentPage = $currentPage;
        return $this;
    }
    /**
     * How many pages the query has. An empty collection has **one** page — the
     * first one, empty — so the smallest value a canonical route returns is `1`.
     * 
     * The deprecated flat aliases (`/v1/invoices`, `/v1/customers`, …) answer `0`
     * for that same empty collection, and `has_next`/`has_previous` follow suit.
     * They were left as they were on purpose: a client that reads `total_pages == 0`
     * as "no results" would break if it changed under it. Do not compare the two
     * families of routes field by field; read `total_items` if what you want to know
     * is whether anything came back.
     * 
     *
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
    /**
    * How many pages the query has. An empty collection has **one** page — the
    first one, empty — so the smallest value a canonical route returns is `1`.
    
    The deprecated flat aliases (`/v1/invoices`, `/v1/customers`, …) answer `0`
    for that same empty collection, and `has_next`/`has_previous` follow suit.
    They were left as they were on purpose: a client that reads `total_pages == 0`
    as "no results" would break if it changed under it. Do not compare the two
    families of routes field by field; read `total_items` if what you want to know
    is whether anything came back.
    
    *
    * @param int $totalPages
    *
    * @return self
    */
    public function setTotalPages(int $totalPages): self
    {
        $this->initialized['totalPages'] = true;
        $this->totalPages = $totalPages;
        return $this;
    }
    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }
    /**
     * @param int $totalItems
     *
     * @return self
     */
    public function setTotalItems(int $totalItems): self
    {
        $this->initialized['totalItems'] = true;
        $this->totalItems = $totalItems;
        return $this;
    }
    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }
    /**
     * @param int $itemsPerPage
     *
     * @return self
     */
    public function setItemsPerPage(int $itemsPerPage): self
    {
        $this->initialized['itemsPerPage'] = true;
        $this->itemsPerPage = $itemsPerPage;
        return $this;
    }
    /**
     * @return bool
     */
    public function getHasNext(): bool
    {
        return $this->hasNext;
    }
    /**
     * @param bool $hasNext
     *
     * @return self
     */
    public function setHasNext(bool $hasNext): self
    {
        $this->initialized['hasNext'] = true;
        $this->hasNext = $hasNext;
        return $this;
    }
    /**
     * @return bool
     */
    public function getHasPrevious(): bool
    {
        return $this->hasPrevious;
    }
    /**
     * @param bool $hasPrevious
     *
     * @return self
     */
    public function setHasPrevious(bool $hasPrevious): self
    {
        $this->initialized['hasPrevious'] = true;
        $this->hasPrevious = $hasPrevious;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['currentPage' => ['current_page', 'getCurrentPage', 'setCurrentPage'], 'totalPages' => ['total_pages', 'getTotalPages', 'setTotalPages'], 'totalItems' => ['total_items', 'getTotalItems', 'setTotalItems'], 'itemsPerPage' => ['items_per_page', 'getItemsPerPage', 'setItemsPerPage'], 'hasNext' => ['has_next', 'getHasNext', 'setHasNext'], 'hasPrevious' => ['has_previous', 'getHasPrevious', 'setHasPrevious']];
    }
}
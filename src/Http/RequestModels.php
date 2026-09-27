<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Lenorix\BeelSdk\Generated\Normalizer\JaneObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Builds generated request models from arrays in API format, like the plain objects of the official Node.js SDK.
 *
 * @internal
 */
final class RequestModels
{
    private static ?Serializer $serializer = null;

    /**
     * Return the model as is, or build it from an array that uses the API's field names.
     *
     * @template T of object
     *
     * @param  T|array<array-key, mixed>|null  $value
     * @param  class-string<T>  $class
     * @return ($value is null ? null : T)
     *
     * @throws \InvalidArgumentException If the array does not match the model or lacks a required field.
     */
    public static function from(object|array|null $value, string $class): ?object
    {
        if ($value === null) {
            return null;
        }
        if (is_object($value)) {
            if (! $value instanceof $class) {
                throw new \InvalidArgumentException(sprintf('Expected %s or an array, got %s.', $class, $value::class));
            }

            return $value;
        }

        $serializer = self::$serializer ??= new Serializer([new JaneObjectNormalizer]);
        try {
            $model = $serializer->denormalize($value, $class, 'json');
        } catch (\Throwable $exception) {
            throw new \InvalidArgumentException(sprintf('The array does not match %s: %s', $class, $exception->getMessage()), previous: $exception);
        }
        if (! $model instanceof $class) {
            throw new \InvalidArgumentException(sprintf('The array does not match %s.', $class));
        }

        // Serialize once now, so a missing required field fails here with a clear message
        // instead of as a TypeError while the request is being sent.
        try {
            $serializer->normalize($model, 'json');
        } catch (\TypeError $exception) {
            $field = preg_match('/::get([A-Za-z0-9]+)\(\)/', $exception->getMessage(), $matches) === 1
                ? strtolower((string) preg_replace('/(?<!^)[A-Z]/', '_$0', $matches[1]))
                : 'a required field';
            throw new \InvalidArgumentException(sprintf('The array for %s is missing the required field "%s".', $class, $field), previous: $exception);
        }

        return $model;
    }
}

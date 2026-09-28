<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Reads and writes BeeL `date-time` values for the generated client, which is generated to
 * delegate them here (`custom-string-format-mapping` in `.jane-openapi`).
 *
 * The generated code handles `null` itself for fields a model allows to be null, so a value that
 * reaches this normalizer must be an RFC 3339 date-time: `null`, `""` or words such as
 * `"tomorrow"` fail instead of silently becoming the current time. Fractional seconds are kept
 * up to the microseconds PHP's `DateTime` holds, and date-times are sent with microseconds.
 *
 * @internal
 */
final class DateTimeNormalizer implements DenormalizerInterface, NormalizerInterface
{
    private const RFC3339 = '/^\d{4}-\d{2}-\d{2}[Tt]\d{2}:\d{2}:\d{2}(?:\.\d+)?(?:[Zz]|[+-]\d{2}:\d{2})$/';

    private const FORMAT = 'Y-m-d\TH:i:s.uP';

    /**
     * @param  array<string, mixed>  $context
     *
     * @throws InvalidDateException If the value is not an RFC 3339 date-time.
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): \DateTime
    {
        if (! is_string($data) || preg_match(self::RFC3339, $data) !== 1) {
            throw new InvalidDateException($data, 'RFC 3339 date-time');
        }

        $date = new \DateTime($data);

        // Same as the generated code did: a "Z" zone reads as GMT (+00:00).
        return $date->getTimezone()->getName() === 'Z' ? $date->setTimezone(new \DateTimeZone('GMT')) : $date;
    }

    /**
     * @param  array<string, mixed>  $context
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \DateTime::class;
    }

    /**
     * @param  array<string, mixed>  $context
     */
    public function normalize(mixed $data, ?string $format = null, array $context = []): string
    {
        if (! $data instanceof \DateTimeInterface) {
            throw new \InvalidArgumentException('Only date-times can be normalized.');
        }

        return $data->format(self::FORMAT);
    }

    /**
     * @param  array<string, mixed>  $context
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof \DateTimeInterface;
    }

    /**
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [\DateTimeInterface::class => true, \DateTime::class => true];
    }
}

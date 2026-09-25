<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** A webhook signature, timestamp, or JSON payload failed verification. */
final class WebhookVerificationError extends \RuntimeException {}

<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/**
 * A webhook signature, timestamp, or JSON payload failed verification.
 *
 * Catch a subclass to react to one failure: {@see WebhookHeaderError},
 * {@see WebhookTimestampError}, {@see WebhookSignatureError} or {@see WebhookPayloadError}.
 */
class WebhookVerificationError extends \RuntimeException {}

<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** The signature is valid, but the body is not a JSON object or does not match the BeeL event schema. */
final class WebhookPayloadError extends WebhookVerificationError {}

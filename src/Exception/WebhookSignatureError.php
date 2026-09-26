<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** No `v1` signature matches the body; the secret is wrong or rotated, or the body was changed. */
final class WebhookSignatureError extends WebhookVerificationError {}

<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** The `BeeL-Signature` header is missing or is not `t=timestamp,v1=signature`. */
final class WebhookHeaderError extends WebhookVerificationError {}

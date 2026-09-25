<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** Authentication or authorization failure (HTTP 401 or 403). */
final class BeelAuthError extends BeelApiError {}

<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** Request conflicts with the current resource state (HTTP 409). */
final class BeelConflictError extends BeelApiError {}

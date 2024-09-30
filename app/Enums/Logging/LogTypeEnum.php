<?php

namespace App\Enums\Logging;

use BenSampo\Enum\Enum;

final class LogTypeEnum extends Enum
{
    const USER_REQUEST      = 'USER_REQUEST';
    const SYSTEM_COMMAND    = 'SYSTEM_COMMAND';
    const UNKNOWN           = 'UNKNOWN';
}

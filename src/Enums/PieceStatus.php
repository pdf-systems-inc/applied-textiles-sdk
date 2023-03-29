<?php

namespace Pdfsystems\AppliedTextilesSDK\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static PieceStatus AVAILABLE()
 * @method static PieceStatus QUARANTINED()
 * @method static PieceStatus SECONDS()
 */
class PieceStatus extends Enum
{
    private const AVAILABLE = 'A';
    private const QUARANTINED = 'Q';
    private const SECONDS = 'Q2';
}

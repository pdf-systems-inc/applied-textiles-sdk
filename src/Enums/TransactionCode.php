<?php

namespace Pdfsystems\AppliedTextilesSDK\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static TransactionCode RECEIVE_AND_STOCK()
 * @method static TransactionCode ALLOCATE_AND_SHIP()
 * @method static TransactionCode ALLOCATE_FINISH_AND_SHIP()
 * @method static TransactionCode RECEIVE_FINISH_AND_STOCK()
 */
class TransactionCode extends Enum
{
    private const RECEIVE_AND_STOCK = '01';
    private const ALLOCATE_AND_SHIP = '02';
    private const ALLOCATE_FINISH_AND_SHIP = '03';
    private const RECEIVE_FINISH_AND_STOCK = '05';
}

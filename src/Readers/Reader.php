<?php

namespace Pdfsystems\AppliedTextilesSDK\Readers;

use Pdfsystems\AppliedTextilesSDK\Dtos\Inventory;

interface Reader
{
    /**
     * @return Inventory[]
     */
    public function readInventory(): array;
}

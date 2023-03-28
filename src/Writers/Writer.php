<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;

interface Writer
{
    public function write(TransactionCollection $transactions): void;
}

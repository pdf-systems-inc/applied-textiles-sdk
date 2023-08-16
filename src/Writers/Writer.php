<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;

interface Writer
{
    /**
     * Writes a collection of transactions to the underlying data store.
     * @param TransactionCollection $transactions
     * @return void
     */
    public function write(TransactionCollection $transactions): void;
}

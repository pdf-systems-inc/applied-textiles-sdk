<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;
use Pdfsystems\AppliedTextilesSDK\Exceptions\WriterException;

interface Writer
{
    /**
     * Writes a collection of transactions to the underlying data store.
     * @param TransactionCollection $transactions
     * @return void
     * @throws WriterException
     */
    public function write(TransactionCollection $transactions): void;
}

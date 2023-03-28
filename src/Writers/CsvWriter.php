<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use Pdfsystems\AppliedTextilesSDK\Dtos\Transaction;
use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;
use ReflectionClass;
use ReflectionProperty;

class CsvWriter implements Writer
{
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function write(TransactionCollection $transactions): void
    {
        $fh = fopen($this->path, 'w');

        $this->writeHeaders($fh);
        $this->writeData($fh, $transactions);

        fclose($fh);
    }

    private function writeHeaders($fh): void
    {
        fputcsv($fh, Transaction::getPropertyNames());
    }

    private function writeData($fh, TransactionCollection $transactions): void
    {
        foreach ($transactions as $transaction) {
            fputcsv($fh, $transaction->toArray());
        }
    }
}

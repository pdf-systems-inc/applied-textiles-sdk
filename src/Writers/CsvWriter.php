<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use Pdfsystems\AppliedTextilesSDK\Dtos\Transaction;
use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;

class CsvWriter implements Writer
{
    /**
     * The path to the csv file
     *
     * @var string
     */
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

    /**
     * Writes the headers to the csv file, which are the public properties of Transactions
     *
     * @param resource $fh
     * @return void
     */
    private function writeHeaders($fh): void
    {
        fputcsv($fh, Transaction::getPropertyNames());
    }

    /**
     * Writes the transactions themselves to the csv file
     *
     * @param resource $fh
     * @param TransactionCollection $transactions
     * @return void
     */
    private function writeData($fh, TransactionCollection $transactions): void
    {
        foreach ($transactions as $transaction) {
            fputcsv($fh, $transaction->toArray());
        }
    }
}

<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use Pdfsystems\AppliedTextilesSDK\Dtos\Transaction;
use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;
use Pdfsystems\AppliedTextilesSDK\Exceptions\CsvException;

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

    public function writeTransactions(TransactionCollection $transactions): void
    {
        if (($fh = fopen($this->path, 'w')) === false) {
            throw new CsvException('Could not open csv file for writing');
        }

        $this->writeHeaders($fh);
        $this->writeData($fh, $transactions);

        if (fclose($fh) === false) {
            throw new CsvException('Could not close csv file after writing');
        }
    }

    /**
     * Writes the headers to the csv file, which are the public properties of Transactions
     *
     * @param resource $fh
     * @return void
     * @throws CsvException
     */
    private function writeHeaders($fh): void
    {
        if (fputcsv($fh, Transaction::getPropertyNames()) === false) {
            throw new CsvException('Could not write headers to csv file');
        }
    }

    /**
     * Writes the transactions themselves to the csv file
     *
     * @param resource $fh
     * @param TransactionCollection $transactions
     * @return void
     * @throws CsvException
     */
    private function writeData($fh, TransactionCollection $transactions): void
    {
        foreach ($transactions as $transaction) {
            $this->writeTransaction($fh, $transaction);
        }
    }

    /**
     * Writes a single transaction to the csv file
     *
     * @param resource $fh
     * @param Transaction $transaction
     * @return void
     * @throws CsvException
     */
    private function writeTransaction($fh, Transaction $transaction): void
    {
        if (fputcsv($fh, $transaction->toArray()) === false) {
            throw new CsvException('Could not write transaction to csv file');
        }
    }
}

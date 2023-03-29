<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use DateTimeImmutable;
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
            $this->writeTransaction($fh, $transaction);
        }
    }

    /**
     * Writes a single transaction to the csv file
     *
     * @param resource $fh
     * @param Transaction $transaction
     * @return void
     */
    private function writeTransaction($fh, Transaction $transaction): void
    {
        fputcsv($fh, $this->mapTransactionToArray($transaction));
    }

    /**
     * Maps a transaction to an array that can be written to a csv file
     *
     * @param Transaction $transaction
     * @return array
     */
    private function mapTransactionToArray(Transaction $transaction): array
    {
        $array = [];

        foreach ($transaction->toArray() as $key => $value) {
            if (is_bool($value)) {
                // Write boolean values as Y/N instead of 1/0
                $array[$key] = $value ? 'Y' : 'N';
            } elseif ($value instanceof DateTimeImmutable) {
                $array[$key] = $value->format('m/d/Y');
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}

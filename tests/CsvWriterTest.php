<?php

use Pdfsystems\AppliedTextilesSDK\Dtos\Transaction;
use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;
use Pdfsystems\AppliedTextilesSDK\Enums\TransactionCode;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;
use Pdfsystems\AppliedTextilesSDK\Writers\CsvWriter;

it('can write csv files', function () {
    $collection = new TransactionCollection();

    $collection->add(new Transaction(TransactionCode::RECEIVE_AND_STOCK(), [
        'Item' => '1000/01',
        'Quantity' => 5,
        'Warehouse' => Warehouse::GRAND_RAPIDS(),
        'FileGenerationDate' => '2023-01-01',
        'FabricWidth' => '54',
        'ItemDesc' => 'Kensington Red',
        'CustomerID' => '12345',
    ]));

    $path = tempnam(sys_get_temp_dir(), 'csv');
    $writer = new CsvWriter($path);
    $writer->write($collection);

    $fh = fopen($path, 'r');
    $headers = fgetcsv($fh);
    $data = fgetcsv($fh);

    expect($headers)->toBe(Transaction::getPropertyNames());
    expect($data)->toBe([
        '01',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '1000/01',
        '',
        '5',
        '',
        '',
        '',
        '',
        '',
        'GRR',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '2023-01-01',
        '',
        '',
        '54',
        '',
        'Kensington Red',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '12345',
    ]);
});

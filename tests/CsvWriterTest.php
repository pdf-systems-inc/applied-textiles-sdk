<?php

use Pdfsystems\AppliedTextilesSDK\Dtos\Transaction;
use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;
use Pdfsystems\AppliedTextilesSDK\Enums\PieceStatus;
use Pdfsystems\AppliedTextilesSDK\Enums\TransactionCode;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;
use Pdfsystems\AppliedTextilesSDK\Writers\CsvWriter;

it('can write csv files', function () {
    $collection = new TransactionCollection();

    $collection->add(new Transaction(TransactionCode::RECEIVE_AND_STOCK(), [
        'Item' => '1000/01',
        'Quantity' => 5,
        'Warehouse' => Warehouse::GRAND_RAPIDS(),
        'Insurance' => 5.5,
        'FileGenerationDate' => new DateTimeImmutable('2023-01-31'),
        'FabricWidth' => '54',
        'ItemDesc' => 'Kensington Red',
        'CustomerID' => '12345',
        'Reserve' => true,
        'CancelShipment' => false,
        'CompleteShipmentOnly' => true,
        'SupplierPieceStatus' => PieceStatus::AVAILABLE(),
    ]));

    $path = tempnam(sys_get_temp_dir(), 'csv');
    $writer = new CsvWriter($path);
    $writer->writeTransactions($collection);

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
        '5.5',
        '',
        'Y',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '01/31/2023',
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
        'A',
        '',
        'Y',
        'N',
        '12345',
    ]);
});

it('can write csv files and ignore extra fields', function () {
    $collection = new TransactionCollection();

    $collection->add(new Transaction(TransactionCode::RECEIVE_AND_STOCK(), [
        'Item' => '1000/01',
        'Quantity' => 5,
        'Warehouse' => Warehouse::GRAND_RAPIDS(),
        'FileGenerationDate' => new DateTimeImmutable('2023-01-31'),
        'FabricWidth' => '54',
        'ItemDesc' => 'Kensington Red',
        'CustomerID' => '12345',
        'Foo' => 'Bar',
    ]));

    $path = tempnam(sys_get_temp_dir(), 'csv');
    $writer = new CsvWriter($path);
    $writer->writeTransactions($collection);

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
        '0',
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
        '01/31/2023',
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

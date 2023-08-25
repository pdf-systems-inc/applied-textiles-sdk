<?php

use Pdfsystems\AppliedTextilesSDK\Dtos\Transaction;
use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;
use Pdfsystems\AppliedTextilesSDK\Enums\PieceStatus;
use Pdfsystems\AppliedTextilesSDK\Enums\TransactionCode;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;
use Pdfsystems\AppliedTextilesSDK\Writers\FtpWriter;

it('can upload transactions to ftp', function () {
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

    $writer = new FtpWriter('tests', 'shah3ouX', 'localhost', '/ftp/tests', true);
    $writer->writeTransactions($collection);

    // If we got here without throwing an exception, we're good
    expect(true)->toBeTrue();
});

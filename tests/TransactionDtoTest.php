<?php

use Pdfsystems\AppliedTextilesSDK\Dtos\Transaction;
use Pdfsystems\AppliedTextilesSDK\Enums\PieceStatus;
use Pdfsystems\AppliedTextilesSDK\Enums\TransactionCode;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;

it('can create transaction DTOs', function () {
    $transaction = new Transaction(TransactionCode::RECEIVE_AND_STOCK(), [
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
    ]);
    expect($transaction)->toBeInstanceOf(Transaction::class);
});

it('can convert transactions to arrays', function () {
    $transaction = new Transaction(TransactionCode::RECEIVE_AND_STOCK(), [
        'Item' => '1000/01',
        'Quantity' => 5,
        'Warehouse' => Warehouse::GRAND_RAPIDS(),
        'Insurance' => 5.5,
        'FileGenerationDate' => $fileGenerationDate = new DateTimeImmutable('2023-01-31'),
        'FabricWidth' => '54',
        'ItemDesc' => 'Kensington Red',
        'CustomerID' => '12345',
        'Reserve' => true,
        'CancelShipment' => false,
        'CompleteShipmentOnly' => true,
        'SupplierPieceStatus' => PieceStatus::AVAILABLE(),
    ]);
    $array = $transaction->toArray();
    expect($array)->toBeArray();
    expect(array_keys($array))->toBe(Transaction::getPropertyNames());

    $expectedValues = array_fill(0, count(Transaction::getPropertyNames()), null);
    $expectedValues[0] = '01';
    $expectedValues[13] = '1000/01';
    $expectedValues[15] = 5.0;
    $expectedValues[21] = 'GRR';
    $expectedValues[23] = 5.5;
    $expectedValues[25] = true;
    $expectedValues[34] = $fileGenerationDate;
    $expectedValues[37] = '54';
    $expectedValues[39] = 'Kensington Red';
    $expectedValues[63] = 'A';
    $expectedValues[65] = true;
    $expectedValues[66] = false;
    $expectedValues[67] = '12345';
    expect(array_values($array))->toBe($expectedValues);
});

it('fails to use invalid transaction DTOs', function () {
    $transaction = new Transaction(TransactionCode::RECEIVE_AND_STOCK());
    expect(fn () => $transaction->toArray())->toThrow(Error::class);
    try {
        $transaction->toArray();
    } catch (Error $e) {
        expect($e->getMessage())->toStartWith('Typed property');
    }
});

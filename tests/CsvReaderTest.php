<?php

use Pdfsystems\AppliedTextilesSDK\Enums\PieceStatus;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;
use Pdfsystems\AppliedTextilesSDK\Readers\CsvReader;

it('can read csv files', function () {
    $reader = new CsvReader('tests/Files/inventory.csv');
    $records = $reader->readInventory();
    expect($records)->toHaveCount(1);
    expect($records[0]->Item)->toBe('1000/01');
    expect($records[0]->Quantity)->toBe(10.0);
    expect($records[0]->SupplierPieceNumber)->toBe('S1');
    expect($records[0]->ATPieceNumber)->toBe('A1');
    expect($records[0]->Location)->toBe('A-123');
    expect($records[0]->Warehouse->getValue())->toBe(Warehouse::GRAND_RAPIDS()->getValue());
    expect($records[0]->UOM)->toBe('Yd');
    expect($records[0]->LotNumber)->toBe('L1');
    expect($records[0]->PieceStatus->getValue())->toBe(PieceStatus::AVAILABLE()->getValue());
    expect($records[0]->Finish)->toBe('Alta');
    expect($records[0]->DateReceived->format('Y-m-d'))->toBe('2023-01-01');
    expect($records[0]->TPartnerField1)->toBe('12345');
});

it('can read csv files with extra characters in headers', function () {
    $reader = new CsvReader('tests/Files/inventory2.csv');
    $records = $reader->readInventory();
    expect($records)->toHaveCount(1);
    expect($records[0]->Item)->toBe('1000/01');
    expect($records[0]->Quantity)->toBe(10.0);
    expect($records[0]->SupplierPieceNumber)->toBe('S1');
    expect($records[0]->ATPieceNumber)->toBe('A1');
    expect($records[0]->Location)->toBe('A-123');
    expect($records[0]->Warehouse->getValue())->toBe(Warehouse::GRAND_RAPIDS()->getValue());
    expect($records[0]->UOM)->toBe('Yd');
    expect($records[0]->LotNumber)->toBe('L1');
    expect($records[0]->PieceStatus->getValue())->toBe(PieceStatus::AVAILABLE()->getValue());
    expect($records[0]->Finish)->toBe('Alta');
    expect($records[0]->DateReceived->format('Y-m-d'))->toBe('2023-01-01');
    expect($records[0]->TPartnerField1)->toBe('12345');
});

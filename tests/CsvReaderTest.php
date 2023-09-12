<?php

use Pdfsystems\AppliedTextilesSDK\Enums\PieceStatus;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;
use Pdfsystems\AppliedTextilesSDK\Readers\CsvReader;

it('can read csv files', function () {
    $reader = new CsvReader('tests/Files/inventory.csv');
    $records = $reader->readInventory();
    expect($records)->toHaveCount(3);
    expect($records[0]->Item)->toBe('10001-01');
    expect($records[0]->Quantity)->toBe(25.625);
    expect($records[0]->SupplierPieceNumber)->toBe('001398559');
    expect($records[0]->ATPieceNumber)->toBe('PC5226398');
    expect($records[0]->Location)->toBe('H-01-08');
    expect($records[0]->Warehouse->getValue())->toBe(Warehouse::GRAND_RAPIDS()->getValue());
    expect($records[0]->UOM)->toBe('Y');
    expect($records[0]->LotNumber)->toBe('00336305/A');
    expect($records[0]->PieceStatus->getValue())->toBe(PieceStatus::AVAILABLE()->getValue());
    expect($records[0]->Finish)->toBe('AT5');
    expect($records[0]->DateReceived->format('Y-m-d'))->toBe('2022-10-05');
    expect($records[0]->TPartnerField1)->toBe('11111');
});

it('can read csv files with extra characters in headers', function () {
    $reader = new CsvReader('tests/Files/inventory2.csv');
    $records = $reader->readInventory();
    expect($records)->toHaveCount(3);
    expect($records[0]->Item)->toBe('10001-01');
    expect($records[0]->Quantity)->toBe(25.625);
    expect($records[0]->SupplierPieceNumber)->toBe('001398559');
    expect($records[0]->ATPieceNumber)->toBe('PC5226398');
    expect($records[0]->Location)->toBe('H-01-08');
    expect($records[0]->Warehouse->getValue())->toBe(Warehouse::GRAND_RAPIDS()->getValue());
    expect($records[0]->UOM)->toBe('Y');
    expect($records[0]->LotNumber)->toBe('00336305/A');
    expect($records[0]->PieceStatus->getValue())->toBe(PieceStatus::AVAILABLE()->getValue());
    expect($records[0]->Finish)->toBe('AT5');
    expect($records[0]->DateReceived->format('Y-m-d'))->toBe('2022-10-05');
    expect($records[0]->TPartnerField1)->toBe('11111');
});

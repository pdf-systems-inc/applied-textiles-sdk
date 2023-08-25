<?php

use Pdfsystems\AppliedTextilesSDK\Enums\PieceStatus;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;
use Pdfsystems\AppliedTextilesSDK\Readers\FtpReader;

it('can read csv files from FTP', function () {

    $ftp = ftp_connect('localhost');
    expect($ftp)->toBeResource();
    expect(ftp_login($ftp, 'tests', 'shah3ouX'))->toBeTrue();
    expect(ftp_pasv($ftp, true))->toBeTrue();
    ftp_fput($ftp, '/ftp/tests/inventory.csv', fopen('tests/Files/inventory.csv', 'r'), FTP_ASCII);

    $reader = new FtpReader('tests', 'shah3ouX', 'localhost', '/ftp/tests', true);

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

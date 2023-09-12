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
    ftp_close($ftp);

    $reader = new FtpReader('tests', 'shah3ouX', 'localhost', '/ftp/tests', true);

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

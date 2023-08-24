<?php

namespace Pdfsystems\AppliedTextilesSDK\Dtos;

use DateTimeInterface;
use Pdfsystems\AppliedTextilesSDK\Dtos\DataTransferObject;
use Pdfsystems\AppliedTextilesSDK\Enums\PieceStatus;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;

class Inventory extends DataTransferObject
{
    public string $Item;
    public float $Quantity;
    public string $SupplierPieceNumber;
    public string $ATPieceNumber;
    public ?string $Location;
    public Warehouse $Warehouse;
    public string $UOM;
    public string $LotNumber;
    public PieceStatus $PieceStatus;
    public ?string $Finish;
    public ?DateTimeInterface $DateReceived;
    public ?string $TPartnerField1;
}

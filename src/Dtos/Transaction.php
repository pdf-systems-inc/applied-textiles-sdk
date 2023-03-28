<?php

namespace Pdfsystems\AppliedTextilesSDK\Dtos;

use ReflectionClass;
use ReflectionProperty;

class Transaction
{
    public string $TransactionCode;
    public ?string $ShipToName = null;
    public ?string $ShipToAdd1 = null;
    public ?string $ShipToAdd2 = null;
    public ?string $ShipToCity = null;
    public ?string $ShipToState = null;
    public ?string $ShipToZip = null;
    public ?string $ShipToCountry = null;
    public ?string $ShipVia = null;
    public ?string $ShipLevel = null;
    public ?string $FreightAccount = null;
    public ?string $Notes = null;
    public ?string $ScheduledDate = null;
    public string $Item;
    public ?string $FinishedItem = null;
    public float $Quantity;
    public ?string $PONumber = null;
    public ?string $POLine = null;
    public ?string $CUSTPONumber = null;
    public ?string $CustPOLine = null;
    public ?string $SupplierPieceNumber = null;
    public string $Warehouse;
    public ?string $FinishRequest = null;
    public ?string $Insurance = null;
    public ?string $OutBoundItem = null;
    public ?string $CompleteShipmentOnly = null;
    public ?string $ThirdPartyBillName = null;
    public ?string $ThirdPartyBillAdd1 = null;
    public ?string $ThirdPartyBillAdd2 = null;
    public ?string $ThirdPartyBillCity = null;
    public ?string $ThirdPartyBillState = null;
    public ?string $ThirdPartyBillZip = null;
    public ?string $ThirdPartyBillCountry = null;
    public ?string $BOL = null;
    public string $FileGenerationDate;
    public ?string $ATPieceNumber = null;
    public ?string $Misc1 = null;
    public string $FabricWidth;
    public ?string $FabricWeight = null;
    public string $ItemDesc;
    public ?string $FinishedItemDesc = null;
    public ?string $TPartnerField1 = null;
    public ?string $TPartnerField2 = null;
    public ?string $TPartnerField3 = null;
    public ?string $TPartnerField4 = null;
    public ?string $TPartnerField5 = null;
    public ?string $TPartnerField6 = null;
    public ?string $TPartnerField7 = null;
    public ?string $TPartnerField8 = null;
    public ?string $TPartnerField9 = null;
    public ?string $TPartnerField10 = null;
    public ?string $TPartnerField11 = null;
    public ?string $TPartnerField12 = null;
    public ?string $TPartnerField13 = null;
    public ?string $TPartnerField14 = null;
    public ?string $TPartnerField15 = null;
    public ?string $TPartnerField16 = null;
    public ?string $TPartnerField17 = null;
    public ?string $TPartnerField18 = null;
    public ?string $Width = null;
    public ?string $UOM = null;
    public ?string $Color = null;
    public ?string $Style = null;
    public ?string $SupplierPieceStatus = null;
    public ?string $LotNumber = null;
    public ?string $Reserve = null;
    public ?string $CancelShipment = null;
    public string $CustomerID;

    public function __construct(string $code, array $args = [])
    {
        $this->TransactionCode = $code;

        $properties = static::getPropertyNames();
        unset($args['TransactionCode']);
        foreach ($args as $key => $value) {
            if (in_array($key, $properties)) {
                $this->{$key} = $value;
            }
        }
    }

    public static function getProperties(): array
    {
        $reflection = new ReflectionClass(Transaction::class);

        return $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
    }

    public static function getPropertyNames(): array
    {
        return array_map(fn ($property) => $property->getName(), static::getProperties());
    }

    public function toArray(): array
    {
        $properties = static::getPropertyNames();
        $array = [];
        foreach ($properties as $property) {
            $array[$property] = $this->{$property};
        }

        return $array;
    }
}

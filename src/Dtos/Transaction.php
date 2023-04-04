<?php

namespace Pdfsystems\AppliedTextilesSDK\Dtos;

use DateTimeInterface;
use MyCLabs\Enum\Enum;
use Pdfsystems\AppliedTextilesSDK\Enums\PieceStatus;
use Pdfsystems\AppliedTextilesSDK\Enums\TransactionCode;
use Pdfsystems\AppliedTextilesSDK\Enums\Warehouse;
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
    public ?DateTimeInterface $ScheduledDate = null;
    public string $Item;
    public ?string $FinishedItem = null;
    public float $Quantity;
    public ?string $PONumber = null;
    public ?string $POLine = null;
    public ?string $CUSTPONumber = null;
    public ?string $CustPOLine = null;
    public ?string $SupplierPieceNumber = null;
    public Warehouse $Warehouse;
    public ?string $FinishRequest = null;
    public float $Insurance = 0;
    public ?string $OutBoundItem = null;
    public ?bool $CompleteShipmentOnly = null;
    public ?string $ThirdPartyBillName = null;
    public ?string $ThirdPartyBillAdd1 = null;
    public ?string $ThirdPartyBillAdd2 = null;
    public ?string $ThirdPartyBillCity = null;
    public ?string $ThirdPartyBillState = null;
    public ?string $ThirdPartyBillZip = null;
    public ?string $ThirdPartyBillCountry = null;
    public ?string $BOL = null;
    public DateTimeInterface $FileGenerationDate;
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
    public ?PieceStatus $SupplierPieceStatus = null;
    public ?string $LotNumber = null;
    public ?bool $Reserve = null;
    public ?bool $CancelShipment = null;
    public string $CustomerID;

    public function __construct(TransactionCode $code, array $args = [])
    {
        $this->TransactionCode = $code;
        unset($args['TransactionCode']);

        $properties = static::getPropertyNames();
        foreach ($args as $key => $value) {
            if (in_array($key, $properties)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Gets all the public properties of the class
     *
     * @return array<ReflectionProperty>
     */
    public static function getProperties(): array
    {
        $reflection = new ReflectionClass(Transaction::class);

        return $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
    }

    /**
     * Gets all the public property names of the class
     *
     * @return array<string>
     */
    public static function getPropertyNames(): array
    {
        return array_map(fn ($property) => $property->getName(), static::getProperties());
    }

    /**
     * Gets an associative array of all the public properties of the class
     *
     * @return array
     */
    public function toArray(): array
    {
        $properties = static::getPropertyNames();
        $array = [];
        foreach ($properties as $property) {
            if ($this->{$property} instanceof Enum) {
                $array[$property] = $this->{$property}->getValue();
            } else {
                $array[$property] = $this->{$property};
            }
        }

        return $array;
    }
}

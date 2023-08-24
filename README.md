# SDK for Applied Textiles

[![Tests](https://img.shields.io/github/actions/workflow/status/pdf-systems-inc/applied-textiles-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/pdf-systems-inc/applied-textiles-sdk/actions/workflows/run-tests.yml)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer, but first you need to add PDF's composer repository to your composer.json file:

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "https://satis.pdfsystems.com"
        }
    ]
}
```

Then you can install the package:

```bash
composer require pdf-systems-inc/applied-textiles-sdk
```

## Usage

### Create a new transaction
```php
$transaction = new \Pdfsystems\AppliedTextilesSDK\Dtos\Transaction(TransactionCode::RECEIVE_AND_STOCK(), [
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
```

### Create a new writer
```php
$writer = new \Pdfsystems\AppliedTextilesSDK\Writers\FtpWriter(
    '{FTP_Username}',
    '{FTP_Password}'
);
```

### Write data to Applied Textiles
```php
$collection = new \Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection([$transaction]);
$writer->writeTransactions($collection);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rob Pungello](https://github.com/rpungello)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

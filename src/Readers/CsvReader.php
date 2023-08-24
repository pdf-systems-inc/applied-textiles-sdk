<?php

namespace Pdfsystems\AppliedTextilesSDK\Readers;

use Pdfsystems\AppliedTextilesSDK\Dtos\Inventory;

class CsvReader implements Reader
{
    protected string $path;
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function readInventory(): array
    {
        $fh = fopen($this->path, 'r');
        $headers = fgetcsv($fh);
        $inventory = [];

        while (! empty($row = fgetcsv($fh))) {
            $inventory[] = new Inventory(array_combine($headers, $row));
        }

        return $inventory;
    }
}

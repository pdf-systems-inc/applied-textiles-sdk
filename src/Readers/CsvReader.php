<?php

namespace Pdfsystems\AppliedTextilesSDK\Readers;

use Exception;
use Pdfsystems\AppliedTextilesSDK\Dtos\Inventory;
use Pdfsystems\AppliedTextilesSDK\Exceptions\InvalidFileException;

class CsvReader implements Reader
{
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function readInventory(): array
    {
        $fh = fopen($this->path, 'r');
        $headers = fgetcsv($fh);

        if ($headers === false) {
            throw new InvalidFileException();
        } elseif (! $this->isValidInventoryFile($headers)) {
            throw new InvalidFileException();
        }

        // Remove any non-alphanumeric characters from the headers
        $headers = array_map(fn (string $value) => preg_replace('/\W/', '', $value), $headers);

        // Skip the second row (it contains a separator between the headers and actual records)
        fgetcsv($fh);

        $inventory = [];
        while (! empty($row = fgetcsv($fh))) {
            $inventory[] = new Inventory(array_combine($headers, $row));
        }

        return $inventory;
    }

    /**
     * @param array $headers
     * @return bool
     */
    private function isValidInventoryFile(array $headers): bool
    {
        return count($headers) === 12;
    }
}

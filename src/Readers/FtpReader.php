<?php

namespace Pdfsystems\AppliedTextilesSDK\Readers;

use Exception;
use Pdfsystems\AppliedTextilesSDK\Concerns\UsesFtp;
use Pdfsystems\AppliedTextilesSDK\Exceptions\InvalidFileException;

class FtpReader
{
    use UsesFtp;

    public function __construct(string $username, string $password, string $host = 'ftp.applied-textiles.com', string $remotePath = '/FROMAT', bool $passive = true)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->remotePath = $remotePath;
        $this->passive = $passive;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function readInventory(): array
    {
        $ftp = $this->getFtpConnection();
        $files = ftp_nlist($ftp, $this->remotePath);
        $inventory = [];

        foreach ($files as $file) {
            if ($this->isValidInventoryFilename($file)) {
                $localPath = $this->getLocalPath();

                $fh = fopen($localPath, 'w');
                ftp_fget($ftp, $fh, $file, FTP_ASCII);
                fclose($fh);

                try {
                    $inventory = array_merge($inventory, $this->processFile($localPath));
                } catch (InvalidFileException $e) {
                    // Ignore invalid files
                } finally {
                    unlink($localPath);
                }
            }
        }

        ftp_close($ftp);

        return $inventory;
    }

    /**
     * @param string $filename
     * @return bool
     */
    private function isValidInventoryFilename(string $filename): bool
    {
        return str_ends_with($filename, '.csv');
    }

    /**
     * @return string
     */
    private function getLocalPath(): string
    {
        return tempnam(sys_get_temp_dir(), 'csv');
    }

    /**
     * @param string $localPath
     * @return array
     * @throws Exception
     */
    private function processFile(string $localPath): array
    {
        $reader = new CsvReader($localPath);

        return $reader->readInventory();
    }
}

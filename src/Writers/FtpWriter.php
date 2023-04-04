<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;
use RuntimeException;

class FtpWriter extends CsvWriter
{
    protected string $host;
    protected string $username;
    protected string $password;
    protected string $remotePath;
    protected bool $passive;

    public function __construct(string $host, string $username, string $password, string $remotePath = '/', bool $passive = false)
    {
        parent::__construct(tempnam(sys_get_temp_dir(), 'csv'));

        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->remotePath = $remotePath;
        $this->passive = $passive;
    }

    /**
     * @inheritDoc
     * @throws RuntimeException If the file could not be uploaded to the FTP server
     */
    public function write(TransactionCollection $transactions): void
    {
        parent::write($transactions);

        $ftp = ftp_connect($this->host);
        if ($ftp === false) {
            throw new RuntimeException('Could not connect to FTP server');
        }

        if (! ftp_login($ftp, $this->username, $this->password)) {
            throw new RuntimeException('Could not login to FTP server');
        }

        if (! ftp_pasv($ftp, $this->passive)) {
            throw new RuntimeException('Could not set FTP passive mode');
        }

        if (! ftp_put($ftp, $this->getFullRemotePath(), $this->path, FTP_ASCII)) {
            throw new RuntimeException('Could not upload file to FTP server');
        }
    }

    private function getFullRemotePath(): string
    {
        $remoteFilename = uniqid() . '.csv';
        return "$this->remotePath/$remoteFilename";
    }
}

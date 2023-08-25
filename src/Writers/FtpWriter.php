<?php

namespace Pdfsystems\AppliedTextilesSDK\Writers;

use Pdfsystems\AppliedTextilesSDK\Concerns\UsesFtp;
use Pdfsystems\AppliedTextilesSDK\Dtos\TransactionCollection;
use Pdfsystems\AppliedTextilesSDK\Exceptions\FtpException;

class FtpWriter extends CsvWriter
{
    use UsesFtp;

    public function __construct(string $username, string $password, string $host = 'ftp.applied-textiles.com', string $remotePath = '/TOAT', bool $passive = true)
    {
        parent::__construct(tempnam(sys_get_temp_dir(), 'csv'));

        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->remotePath = $remotePath;
        $this->passive = $passive;
    }

    public function writeTransactions(TransactionCollection $transactions): void
    {
        parent::writeTransactions($transactions);

        $ftp = $this->getFtpConnection();

        if (! ftp_put($ftp, $this->getFullRemotePath(), $this->path, FTP_ASCII)) {
            throw new FtpException('Could not upload file to FTP server');
        }
    }

    private function getFullRemotePath(): string
    {
        $remoteFilename = uniqid() . '.csv';

        return "$this->remotePath/$remoteFilename";
    }
}

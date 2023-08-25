<?php

namespace Pdfsystems\AppliedTextilesSDK\Concerns;

use Pdfsystems\AppliedTextilesSDK\Exceptions\FtpException;

trait UsesFtp
{
    protected string $host;
    protected string $username;
    protected string $password;
    protected string $remotePath;
    protected bool $passive;

    /**
     * Initializes and returns an FTP connection
     *
     * @return resource
     */
    protected function getFtpConnection()
    {
        $ftp = ftp_connect($this->host);

        if ($ftp === false) {
            throw new FtpException('Could not connect to FTP server');
        }

        if (! ftp_login($ftp, $this->username, $this->password)) {
            throw new FtpException('Could not login to FTP server');
        }

        if (! ftp_pasv($ftp, $this->passive)) {
            throw new FtpException('Could not set FTP passive mode');
        }

        return $ftp;
    }
}

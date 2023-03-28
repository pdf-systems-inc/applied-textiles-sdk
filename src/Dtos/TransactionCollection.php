<?php

namespace Pdfsystems\AppliedTextilesSDK\Dtos;

use IteratorAggregate;
use Ramsey\Collection\Collection;

/**
 * @extends Collection<Transaction>
 * @implements IteratorAggregate<Transaction>
 */
class TransactionCollection extends Collection
{
    public function __construct(array $data = [])
    {
        parent::__construct(Transaction::class, $data);
    }
}

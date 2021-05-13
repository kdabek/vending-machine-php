<?php
declare(strict_types=1);

namespace VendingMachine\Infrastructure\Repository;

use VendingMachine\Domain\Coin\Coin;
use VendingMachine\Domain\Coin\CoinRepository;
use VendingMachine\Domain\Coin\ShortCode;

class InMemoryCoinRepository implements CoinRepository
{
    private array $coins = [];

    public function findByShortCode(ShortCode $code): ?Coin
    {
        if (!in_array($code->getCode(), array_keys($this->coins), true)) {
            return null;
        }

        return $this->coins[$code->getCode()];
    }

    public function save(Coin $coin)
    {
        $this->coins[$coin->getShortCode()->getCode()] = $coin;
    }
}

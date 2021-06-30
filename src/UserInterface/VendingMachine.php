<?php

declare(strict_types=1);

namespace VendingMachine\UserInterface;

use Exception;
use VendingMachine\Application\Service\VendingService;
use VendingMachine\Domain\Coin\View\Coin;

/**
 * @todo Add Response, catch exceptions in handler
 */
final class VendingMachine
{
    public function __construct(private VendingService $vendingService)
    {
    }

    public function insertCoin(string $shortCode): void
    {
        try {
            $this->vendingService->insertCoin($shortCode, 1);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function returnCoins(): void
    {
        try {
            $coins = $this->vendingService->returnCoins();
            /**
             * @todo move it to class (Response or Resource?)
             */
            $shortCodes = array_map(
                fn(Coin $coin): array => array_fill(0, $coin->getQuantity(), $coin->getShortCode()),
                $coins
            );

            $shortCodes = call_user_func_array('array_merge', $shortCodes);

            echo implode(',', $shortCodes);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function service(): string
    {
        return 'service';
    }
}

<?php

declare(strict_types=1);

namespace VendingMachine\Application\Handler;

use VendingMachine\Application\Projection\MachineFinder;
use VendingMachine\Domain\Machine\Query\GetMachine;
use VendingMachine\Domain\Machine\View\Machine;

final class GetMachineHandler
{
    public function __construct(private MachineFinder $finder)
    {
    }

    public function handle(GetMachine $query): Machine
    {
        return $this->finder->findOne();
    }
}

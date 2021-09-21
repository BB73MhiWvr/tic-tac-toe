<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Scenarios;

use PHPUnit\Framework\TestCase;
use TicTacToe\TicTacToe;

abstract class AbstractScenario extends TestCase
{
    protected TicTacToe $ticTacToe;

    protected function setUp(): void
    {
        $this->prepareGameScenario();
        parent::setUp();

    }

    protected function tearDown(): void
    {
        $this->prepareGameScenario();
        parent::tearDown();
    }

    abstract protected function prepareGameScenario(): void;
}

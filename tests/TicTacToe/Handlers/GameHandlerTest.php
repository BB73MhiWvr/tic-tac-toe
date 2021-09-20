<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Handlers;

use PHPUnit\Framework\TestCase;
use Tests\TicTacToe\Traits\PrepareGameSpecificationsTrait;
use Tests\TicTacToe\Traits\PrepareGameTrait;
use TicTacToe\Handlers\GameContinues;
use TicTacToe\Handlers\GameTied;
use TicTacToe\Handlers\GameWon;

class GameHandlerTest extends TestCase
{
    use PrepareGameTrait;
    use PrepareGameSpecificationsTrait;

    public function testShouldReturnWonGame(): void
    {
        $gameHandlerChain = new GameWon(
            $this->prepareFulfilledGameSpecification(),
            new GameTied(
                $this->prepareFulfilledGameSpecification(),
                new GameContinues()
            )
        );

        $handledGame = $gameHandlerChain->handle($this->prepareGame());
        self::assertTrue($handledGame->isWon());
        self::assertFalse($handledGame->isTied());
    }

    public function testShouldReturnTiedGame(): void
    {
        $gameHandlerChain = new GameWon(
            $this->prepareNotFulfilledGameSpecification(),
            new GameTied(
                $this->prepareFulfilledGameSpecification(),
                new GameContinues()
            )
        );

        $handledGame = $gameHandlerChain->handle($this->prepareGame());
        self::assertFalse($handledGame->isWon());
        self::assertTrue($handledGame->isTied());
    }

    public function testShouldReturnNeitherWonNorTiedGame(): void
    {
        $gameHandlerChain = new GameWon(
            $this->prepareNotFulfilledGameSpecification(),
            new GameTied(
                $this->prepareNotFulfilledGameSpecification(),
                new GameContinues()
            )
        );

        $handledGame = $gameHandlerChain->handle($this->prepareGame());
        self::assertFalse($handledGame->isWon());
        self::assertFalse($handledGame->isTied());
    }
}

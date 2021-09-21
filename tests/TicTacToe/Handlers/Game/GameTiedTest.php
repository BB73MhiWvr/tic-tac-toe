<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Handlers\Game;

use PHPUnit\Framework\TestCase;
use Tests\TicTacToe\Traits\PrepareGameSpecificationsTrait;
use Tests\TicTacToe\Traits\PrepareGameTrait;
use TicTacToe\Handlers\Game\GameTied;

class GameTiedTest extends TestCase
{
    use PrepareGameTrait;
    use PrepareGameSpecificationsTrait;

    public function testShouldReturnSameGameOnNotFulfilledCondition(): void
    {
        $game = $this->prepareGame();
        $gameTied = new GameTied($this->prepareNotFulfilledGameSpecification());

        self::assertSame($game, $gameTied->handle($game));
    }

    public function testShouldReturnGameWithoutIsTiedFlag(): void
    {
        $game = $this->prepareGame();
        $gameTied = new GameTied($this->prepareNotFulfilledGameSpecification());

        $handledGame = $gameTied->handle($game);
        self::assertFalse($handledGame->isTied());
    }

    public function testShouldReturnGameWithIsTiedFlag(): void
    {
        $game = $this->prepareGame();
        $gameTied = new GameTied($this->prepareFulfilledGameSpecification());

        $handledGame = $gameTied->handle($game);
        self::assertTrue($handledGame->isTied());
    }

    public function testShouldChangeActivePlayer(): void
    {
        $game = $this->prepareGame();
        $gameTied = new GameTied($this->prepareFulfilledGameSpecification());
        $activePlayer = $game->getPlayerService()->getActivePlayer();

        $handledGame = $gameTied->handle($game);
        self::assertNotEquals($activePlayer, $handledGame->getPlayerService()->getActivePlayer());
    }

    public function testShouldNotChangePlayerScore(): void
    {
        $game = $this->prepareGame();
        $gameTied = new GameTied($this->prepareFulfilledGameSpecification());
        $player = $game->getPlayerService()->getActivePlayer();
        $playerScore = $player->getScore();

        $gameTied->handle($game);
        self::assertSame($playerScore, $player->getScore());
    }
}

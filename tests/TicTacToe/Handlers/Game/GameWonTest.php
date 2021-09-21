<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Handlers\Game;

use PHPUnit\Framework\TestCase;
use Tests\TicTacToe\Traits\PrepareGameSpecificationsTrait;
use Tests\TicTacToe\Traits\PrepareGameTrait;
use TicTacToe\Handlers\Game\GameWon;
use TicTacToe\Strategy\NextRoundBeginner\LooserBegins;

class GameWonTest extends TestCase
{
    use PrepareGameTrait;
    use PrepareGameSpecificationsTrait;

    public function testShouldReturnSameGameOnNotFulfilledCondition(): void
    {
        $game = $this->prepareGame();
        $gameWon = new GameWon($this->prepareNotFulfilledGameSpecification());

        self::assertSame($game, $gameWon->handle($game));
    }

    public function testShouldReturnGameWithoutIsWonFlag(): void
    {
        $game = $this->prepareGame();
        $gameWon = new GameWon($this->prepareNotFulfilledGameSpecification());

        $handledGame = $gameWon->handle($game);
        self::assertFalse($handledGame->isWon());
    }

    public function testShouldReturnGameWithIsWonFlag(): void
    {
        $game = $this->prepareGame();
        $gameWon = new GameWon($this->prepareFulfilledGameSpecification());

        $handledGame = $gameWon->handle($game);
        self::assertTrue($handledGame->isWon());
    }

    public function testShouldChangePlayerScore(): void
    {
        $game = $this->prepareGame();
        $gameWon = new GameWon($this->prepareFulfilledGameSpecification());
        $player = $game->getPlayerService()->getActivePlayer();
        $playerScore = $player->getScore();

        $gameWon->handle($game);
        self::assertNotSame($playerScore, $player->getScore());
    }

    public function testShouldNotChangeActivePlayerForWinnerBegins(): void
    {
        $game = $this->prepareGame();
        $gameWon = new GameWon($this->prepareFulfilledGameSpecification());
        $activePlayer = $game->getPlayerService()->getActivePlayer();

        $handledGame = $gameWon->handle($game);
        self::assertEquals($activePlayer, $handledGame->getPlayerService()->getActivePlayer());
    }

    public function testShouldChangeActivePlayerForLooserBegins(): void
    {
        $game = $this->prepareGame(new LooserBegins());
        $gameWon = new GameWon($this->prepareFulfilledGameSpecification());
        $activePlayer = $game->getPlayerService()->getActivePlayer();

        $handledGame = $gameWon->handle($game);
        self::assertNotEquals($activePlayer, $handledGame->getPlayerService()->getActivePlayer());
    }
}

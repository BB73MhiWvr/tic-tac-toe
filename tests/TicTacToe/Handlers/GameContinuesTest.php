<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Handlers;

use PHPUnit\Framework\TestCase;
use Tests\TicTacToe\Traits\PrepareGameTrait;
use TicTacToe\Handlers\GameContinues;

class GameContinuesTest extends TestCase
{
    use PrepareGameTrait;

    public function testShouldChangeActivePlayer(): void
    {
        $game = $this->prepareGame();
        $gameContinues = new GameContinues();
        $activePlayer = $game->getPlayerService()->getActivePlayer();

        $handledGame = $gameContinues->handle($game);
        self::assertNotEquals($activePlayer, $handledGame->getPlayerService()->getActivePlayer());
    }
}

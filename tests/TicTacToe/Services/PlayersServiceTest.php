<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Services;

use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;
use PHPUnit\Framework\TestCase;

class PlayersServiceTest extends TestCase
{
    public function testShouldGetFirstPlayerOnTurn(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $actual = $playerService->getActivePlayer();
        self::assertEquals($firstPlayer, $actual);
    }

    public function testShouldGetSecondPlayerOnTurnAfterSwitch(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $playerService->switchActivePlayer();

        $actual = $playerService->getActivePlayer();
        self::assertEquals($secondPlayer, $actual);
    }

    public function testShouldGetSecondPlayerOnTurnAfterDoubleSwitch(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $playerService->switchActivePlayer();
        $playerService->switchActivePlayer();

        $actual = $playerService->getActivePlayer();
        self::assertEquals($firstPlayer, $actual);
    }

    public function testShouldIncrementActivePlayerScore(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $activePlayer = $playerService->getActivePlayer();
        self::assertEquals(0, $activePlayer->getScore());

        $playerService->proclaimActivePlayerWin();
        $activePlayer = $playerService->getActivePlayer();
        self::assertEquals(1, $activePlayer->getScore());
    }

    public function testShouldIncrementTwiceBothPlayersScore(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $playerService->proclaimActivePlayerWin();
        $playerService->proclaimActivePlayerWin();

        $activeFirstPlayer = $playerService->getActivePlayer();
        self::assertEquals(2, $activeFirstPlayer->getScore());

        $playerService->switchActivePlayer();
        $playerService->proclaimActivePlayerWin();
        $playerService->proclaimActivePlayerWin();

        $activeSecondPlayer = $playerService->getActivePlayer();
        self::assertEquals(2, $activeSecondPlayer->getScore());
    }

    public function testShouldReturnPlayersIds(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $expected = ['player one', 'player two'];
        self::assertEquals($expected, $playerService->getPlayersIds());
    }
}

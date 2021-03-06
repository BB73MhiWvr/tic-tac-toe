<?php
declare(strict_types=1);

namespace Tests\TicTacToe\Specifications\Move;

use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;
use TicTacToe\Specifications\Move\IsProperPlayerMove;
use PHPUnit\Framework\TestCase;

class IsProperPlayerMoveTest extends TestCase
{
    public function testShouldReturnFalseWhenNotActivePlayerAddsMove(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $isProperPlayerMove = new IsProperPlayerMove($playerService);
        $move = new Move($playerService->getActivePlayer()->getId(), 1, 1);

        $playerService->switchActivePlayer();
        self::assertFalse($isProperPlayerMove->isSatisfiedBy($move));
    }

    public function testShouldReturnTrueWhenActivePlayerAddsMove(): void
    {
        $firstPlayer = new Player('player one');
        $secondPlayer = new Player('player two');
        $playerService = new PlayerService($firstPlayer, $secondPlayer);

        $isProperPlayerMove = new IsProperPlayerMove($playerService);
        $move = new Move($playerService->getActivePlayer()->getId(), 1, 1);

        self::assertTrue($isProperPlayerMove->isSatisfiedBy($move));
    }
}

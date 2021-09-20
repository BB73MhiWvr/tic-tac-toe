<?php
declare(strict_types=1);

namespace Test\TicTacToe\Entities;

use PHPUnit\Framework\TestCase;
use Tests\TicTacToe\Traits\PrepareGameTrait;

class GameTest extends TestCase
{
    use PrepareGameTrait;

    public function testShouldReturnIsWonAsFalseOnInit(): void
    {
        $game = $this->prepareGame();
        self::assertFalse($game->isWon());
    }

    public function testShouldReturnIsWonAsTrueAfterSetting(): void
    {
        $game = $this->prepareGame();
        $game->setIsWon(true);
        self::assertTrue($game->isWon());
    }

    public function testShouldReturnIsWonAsFalseAfterRemoving(): void
    {
        $game = $this->prepareGame();
        $game->setIsWon(true);
        $game->setIsWon(false);
        self::assertFalse($game->isWon());
    }

    public function testShouldReturnIsTiedAsFalseOnInit(): void
    {
        $game = $this->prepareGame();
        self::assertFalse($game->isTied());
    }

    public function testShouldReturnIsTiedAsTrueAfterSetting(): void
    {
        $game = $this->prepareGame();
        $game->setIsTied(true);
        self::assertTrue($game->isTied());
    }

    public function testShouldReturnIsTiedAsFalseAfterRemoving(): void
    {
        $game = $this->prepareGame();
        $game->setIsTied(true);
        $game->setIsTied(false);
        self::assertFalse($game->isTied());
    }
}

<?php
declare(strict_types=1);

namespace TicTacToe\Entities;

use TicTacToe\Services\BoardService;
use TicTacToe\Services\PlayerService;
use TicTacToe\Strategy\NextRoundBeginner\NextRoundBeginnerStrategy;

class Game
{
    private BoardService $boardService;
    private PlayerService $playerService;
    private NextRoundBeginnerStrategy $nextRoundBeginnerStrategy;
    private bool $isWon = false;
    private bool $isTied = false;

    public function __construct(
        BoardService $boardService,
        PlayerService $playerService,
        NextRoundBeginnerStrategy $nextRoundBeginnerStrategy
    ) {
        $this->boardService = $boardService;
        $this->playerService = $playerService;
        $this->nextRoundBeginnerStrategy = $nextRoundBeginnerStrategy;
    }

    public function getBoardService(): BoardService
    {
        return $this->boardService;
    }

    public function getPlayerService(): PlayerService
    {
        return $this->playerService;
    }

    public function getNextRoundBeginnerStrategy(): NextRoundBeginnerStrategy
    {
        return $this->nextRoundBeginnerStrategy;
    }

    public function setIsWon(bool $isWon): void
    {
        $this->isWon = $isWon;
    }

    public function isWon(): bool
    {
        return $this->isWon;
    }

    public function setIsTied(bool $isTied): void
    {
        $this->isTied = $isTied;
    }

    public function isTied(): bool
    {
        return $this->isTied;
    }
}

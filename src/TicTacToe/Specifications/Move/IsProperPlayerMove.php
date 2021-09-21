<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Move;

use TicTacToe\Entities\Move;
use TicTacToe\Services\PlayerService;

class IsProperPlayerMove implements MoveSpecification
{
    private PlayerService $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function isSatisfiedBy(Move $move): bool
    {
        if ($move->getPlayerId() === $this->playerService->getActivePlayer()->getId()) {
            return true;
        }

        return false;
    }
}

<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game\WinConditions;

use TicTacToe\Entities\Player;
use TicTacToe\Services\BoardService;

class IsRowFilled extends WinConditionSpecification
{
    public function isSatisfiedBy(BoardService $boardService, Player $player): bool
    {
        $moves = $boardService->getPlayerMoves($player);
        for ($row = 0; $row < $boardService->getBoardSize(); $row++) {
            $found = $this->getMovesFound(moves: $moves, row: $row);
            if ($found === $boardService->getBoardSize()) {
                return true;
            }
        }

        return false;
    }
}

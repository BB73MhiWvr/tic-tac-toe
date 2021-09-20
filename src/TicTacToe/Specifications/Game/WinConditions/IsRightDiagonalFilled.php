<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game\WinConditions;

use TicTacToe\Entities\Player;
use TicTacToe\Services\BoardService;

class IsRightDiagonalFilled extends WinConditionSpecification
{
    public function isSatisfiedBy(BoardService $boardService, Player $player): bool
    {
        $moves = $boardService->getPlayerMoves($player);
        $found = 0;
        for ($row = 0; $row < $boardService->getBoardSize(); $row++) {
            $column = $boardService->getBoardSize() - 1 - $row;
            $found+= $this->getMovesFound($moves,$column, $row);
            if ($found === $boardService->getBoardSize()) {
                return true;
            }
        }

        return false;
    }
}

<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game\WinConditions;

use TicTacToe\Services\BoardService;

class IsLeftDiagonalFilled extends WinConditionSpecification
{
    public function isSatisfiedBy(BoardService $boardService, string $playerId): bool
    {
        $moves = $boardService->getPlayerMoves($playerId);
        $found = 0;
        for ($row = 0; $row < $boardService->getBoardSize(); $row++) {
            $column = $row;
            $found+= $this->getMovesFound($moves, $column, $row);
            if ($found === $boardService->getBoardSize()) {
                return true;
            }
        }

        return false;
    }
}

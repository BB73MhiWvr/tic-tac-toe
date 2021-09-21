<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game\WinConditions;

use TicTacToe\Services\BoardService;

class IsColumnFilled extends WinConditionSpecification
{
    public function isSatisfiedBy(BoardService $boardService, string $playerId): bool
    {
        $moves = $boardService->getPlayerMoves($playerId);
        for ($column = 0; $column < $boardService->getBoardSize(); $column++) {
            $found = $this->getMovesFound(moves: $moves, column: $column);
            if ($found === $boardService->getBoardSize()) {
                return true;
            }
        }

        return false;
    }
}

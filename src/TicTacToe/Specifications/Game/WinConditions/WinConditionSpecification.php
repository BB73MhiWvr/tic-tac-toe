<?php
declare(strict_types=1);

namespace TicTacToe\Specifications\Game\WinConditions;

use TicTacToe\Entities\Move;
use TicTacToe\Services\BoardService;

abstract class WinConditionSpecification
{
    abstract public function isSatisfiedBy(BoardService $boardService, string $playerId): bool;

    protected function getMovesFound(array $moves, ?int $column = null, ?int $row = null): int
    {
        return sizeof(
            array_filter(
                $moves,
                function (Move $move) use ($column, $row) {
                    if (is_null($column)) {
                        return $move->getRow() === $row;
                    }
                    if (is_null($row)) {
                        return $move->getColumn() === $column;
                    }

                    return ($move->getColumn() === $column && $move->getRow() === $row);
                }
            )
        );
    }
}

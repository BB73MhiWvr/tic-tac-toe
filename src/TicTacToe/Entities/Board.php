<?php
declare(strict_types=1);

namespace TicTacToe\Entities;

class Board
{
    private array $moves = [];

    public function addMove(Move $move): void
    {
        array_push($this->moves, $move);
    }

    public function getMoves(): array
    {
        return $this->moves;
    }
}

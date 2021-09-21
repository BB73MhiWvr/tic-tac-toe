<?php
declare(strict_types=1);

namespace TicTacToe\Entities;

class Move
{
    private string $playerId;
    private int $column;
    private int $row;

    public function __construct(string $playerId, int $column, int $row)
    {
        $this->playerId = $playerId;
        $this->column = $column;
        $this->row = $row;
    }

    public function getPlayerId(): string
    {
        return $this->playerId;
    }

    public function getColumn(): int
    {
        return $this->column;
    }

    public function getRow(): int
    {
        return $this->row;
    }
}

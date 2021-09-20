<?php
declare(strict_types=1);

namespace TicTacToe\Entities;

class Move
{
    private Player $player;
    private int $column;
    private int $row;

    public function __construct(Player $player, int $column, int $row)
    {
        $this->player = $player;
        $this->column = $column;
        $this->row = $row;
    }

    public function getPlayer(): Player
    {
        return $this->player;
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

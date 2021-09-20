<?php
declare(strict_types=1);

namespace TicTacToe\Entities;

class Player
{
    private string $symbol;
    private int $score = 0;

    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function incrementScore(): void
    {
        $this->score++;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}

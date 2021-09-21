<?php
declare(strict_types=1);

namespace TicTacToe\Entities;

class Player
{
    private string $id;
    private int $score = 0;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
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

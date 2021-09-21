<?php
declare(strict_types=1);

namespace TicTacToe\Services;

use TicTacToe\Entities\Player;

class PlayerService
{
    private Player $first;
    private Player $second;
    private Player $active;

    public function __construct(Player $first, Player $second)
    {
        $this->first = $first;
        $this->second = $second;
        $this->active = $first;
    }

    public function getFirstPlayer(): Player
    {
        return $this->first;
    }

    public function getSecondPlayer(): Player
    {
        return $this->second;
    }

    public function getActivePlayer(): Player
    {
        return $this->active;
    }

    public function switchActivePlayer(): void
    {
        $this->active = ($this->active === $this->first) ? $this->second : $this->first;
    }

    public function proclaimActivePlayerWin(): void
    {
        $player = $this->getActivePlayer();
        $player->incrementScore();
    }
}

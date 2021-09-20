<?php
declare(strict_types=1);

namespace TicTacToe\Services;

use TicTacToe\Entities\Player;

class PlayerService
{
    private array $players = [];

    public function __construct(Player $first, Player $second)
    {
        array_push($this->players, $first);
        array_push($this->players, $second);
    }

    public function getActivePlayer(): Player
    {
        return reset($this->players);
    }

    public function switchActivePlayer(): void
    {
        array_push($this->players, array_shift($this->players));
    }

    public function proclaimActivePlayerWin(): void
    {
        $player = $this->getActivePlayer();
        $player->incrementScore();
    }
}

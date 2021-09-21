<?php
declare(strict_types=1);

namespace TicTacToe\Services;

use TicTacToe\Entities\Player;

class PlayerService
{
    private Player $firstPlayer;
    private Player $secondPlayer;
    private Player $activePlayer;

    public function __construct(Player $firstPlayer, Player $secondPlayer)
    {
        $this->firstPlayer = $firstPlayer;
        $this->secondPlayer = $secondPlayer;
        $this->activePlayer = $firstPlayer;
    }

    public function getFirstPlayer(): Player
    {
        return $this->firstPlayer;
    }

    public function getSecondPlayer(): Player
    {
        return $this->secondPlayer;
    }

    public function getActivePlayer(): Player
    {
        return $this->activePlayer;
    }

    public function switchActivePlayer(): void
    {
        $this->activePlayer = ($this->activePlayer === $this->firstPlayer) ? $this->secondPlayer : $this->firstPlayer;
    }

    public function proclaimActivePlayerWin(): void
    {
        $player = $this->getActivePlayer();
        $player->incrementScore();
    }

    public function getPlayersIds(): array
    {
        return [$this->firstPlayer->getId(), $this->secondPlayer->getId()];
    }
}

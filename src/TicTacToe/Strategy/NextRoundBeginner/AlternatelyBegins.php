<?php
declare(strict_types=1);

namespace TicTacToe\Strategy\NextRoundBeginner;

use TicTacToe\Entities\Player;
use TicTacToe\Services\PlayerService;

class AlternatelyBegins implements NextRoundBeginnerStrategy
{
    private Player $currentRoundBeginner;

    public function __construct(PlayerService $playerService)
    {
        $this->currentRoundBeginner = $playerService->getActivePlayer();
    }
    public function choose(PlayerService $playerService): void
    {
        if ($this->currentRoundBeginner === $playerService->getActivePlayer()) {
            $playerService->switchActivePlayer();
        }

        $this->currentRoundBeginner = $playerService->getActivePlayer();
    }
}

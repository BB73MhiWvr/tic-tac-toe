<?php
declare(strict_types=1);

namespace TicTacToe\Strategy\NextRoundBeginner;

use TicTacToe\Services\PlayerService;

class WinnerBegins implements NextRoundBeginnerStrategy
{
    public function choose(PlayerService $playerService): void
    {

    }
}

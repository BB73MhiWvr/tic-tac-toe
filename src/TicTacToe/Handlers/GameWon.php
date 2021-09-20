<?php
declare(strict_types=1);

namespace TicTacToe\Handlers;

use TicTacToe\Entities\Game;
use TicTacToe\Specifications\Game\GameSpecification;

class GameWon extends AbstractGameHandler
{
    private GameSpecification $gameSpecification;

    public function __construct(GameSpecification $gameSpecification, ?AbstractGameHandler $nextGameHandler = null)
    {
        $this->gameSpecification = $gameSpecification;
        parent::__construct($nextGameHandler);
    }

    protected function handleGame(Game $game): ?Game
    {
        if (!$this->gameSpecification->isSatisfiedBy($game)) {
            return null;
        }

        $game->setIsWon(true);
        $game->getPlayerService()->proclaimActivePlayerWin();
        $game->getNextRoundBeginnerStrategy()->choose($game->getPlayerService());

        return $game;
    }
}

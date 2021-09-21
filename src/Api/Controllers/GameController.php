<?php
declare(strict_types=1);

namespace Api\Controllers;

use Api\Configuration\GameConfiguration;
use Api\Decorators\GameDecorator;
use Api\Exceptions\GameServiceCacheException;
use Api\Services\GameService;
use TicTacToe\Exceptions\ImproperBoardMoveException;
use TicTacToe\Exceptions\ImproperPlayerException;
use TicTacToe\Exceptions\ImproperPlayerMoveException;
use TicTacToe\Exceptions\MoveException;

class GameController
{
    use ControllerTrait;

    public function show(): void
    {
        $gameService = new GameService(new GameConfiguration());

        try {
            $ticTacToe = $gameService->getTicTacToe();

            $this->sendResponse(GameDecorator::format($ticTacToe->getGame()));
        } catch (GameServiceCacheException) {
            $this->sendServerErrorResponse();
        }
    }

    public function store(string $piece): void
    {
        $gameService = new GameService(new GameConfiguration());

        try {
            $ticTacToe = $gameService->getTicTacToe();
            $ticTacToe->registerMove($piece, (int) $_POST['x'], (int) $_POST['y']);
            $gameService->saveTicTacToe($ticTacToe);

            $this->sendResponse(GameDecorator::format($ticTacToe->getGame()));
        } catch (ImproperPlayerException) {
            $this->sendNotFoundErrorResponse();
        } catch (ImproperPlayerMoveException) {
            $this->sendNotAcceptableRequestErrorResponse();
        } catch (ImproperBoardMoveException) {
            $this->sendConflictErrorResponse();
        } catch (GameServiceCacheException | MoveException) {
            $this->sendServerErrorResponse();
        }
    }

    public function destroy(): void
    {
        $gameService = new GameService(new GameConfiguration());

        try {
            $ticTacToe = $gameService->getTicTacToe();
            $ticTacToe->deleteGame();
            $gameService->saveTicTacToe($ticTacToe);

            $this->sendResponse(GameDecorator::formatCurrentTurnOnly($ticTacToe->getGame()));
        } catch (GameServiceCacheException) {
            $this->sendServerErrorResponse();
        }
    }

    public function reset(): void
    {
        $gameService = new GameService(new GameConfiguration());

        try {
            $ticTacToe = $gameService->getTicTacToe();
            $ticTacToe->restartGame();
            $gameService->saveTicTacToe($ticTacToe);

            $this->sendResponse(GameDecorator::format($ticTacToe->getGame()));
        } catch (GameServiceCacheException) {
            $this->sendServerErrorResponse();
        }
    }
}

<?php
declare(strict_types=1);

namespace TicTacToe\Services;

use TicTacToe\Entities\Board;
use TicTacToe\Entities\Move;
use TicTacToe\Entities\Player;

class BoardService
{
    private const BOARD_SIZE = 3;

    private Board $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function getBoardSize(): int
    {
        return self::BOARD_SIZE;
    }

    public function clearBoard(): void
    {
        $this->board = new Board();
    }

    public function isBoardFilled(): bool
    {
        return sizeof($this->board->getMoves()) >= pow($this->getBoardSize(), 2);
    }

    public function isEmptySpaceOnBoard(Move $move): bool
    {
        $found = array_filter(
            $this->getMoves(),
            function (Move $boardMove) use ($move) {
                if ($move->getColumn() !== $boardMove->getColumn()) {
                    return false;
                }
                if ($move->getRow() !== $boardMove->getRow()) {
                    return false;
                }
                return true;
            }
        );

        return empty($found);
    }

    public function addMoveToBoard(Move $move): void
    {
        if ($this->isEmptySpaceOnBoard($move)) {
            $this->board->addMove($move);
        }
    }

    public function getMoves(): array
    {
        return $this->board->getMoves();
    }

    public function getPlayerMoves(Player $player): array
    {
        return array_filter(
            $this->board->getMoves(),
            function (Move $move) use ($player) {
                return $move->getPlayer() === $player;
            }
        );
    }
}

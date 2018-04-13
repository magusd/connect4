<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/8/18
 * Time: 4:51 PM
 */

namespace Connect4\Player;


use Connect4\Board\BoardInterface;
use Connect4\Board\Exceptions\BoardColumnIsFullException;
use Connect4\Board\Exceptions\InvalidColumnException;

class HumanPlayer extends BasePlayer implements PlayerInterface
{
    public function play(BoardInterface $board,$move = null)
    {
        $board->addPiece($this->getPiece(),$move);
        return true;
    }
}
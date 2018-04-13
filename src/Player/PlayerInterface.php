<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/8/18
 * Time: 4:51 PM
 */

namespace Connect4\Player;


use Connect4\Board\BoardInterface;
use Connect4\Board\Piece\Piece;

interface PlayerInterface
{
    public function setPiece(Piece $piece);
    public function getPiece();
    public function play(BoardInterface $board,$move = null);
}
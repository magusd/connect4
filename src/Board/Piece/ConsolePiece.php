<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/9/18
 * Time: 1:33 AM
 */

namespace Connect4\Board\Piece;


class ConsolePiece extends Piece
{
    public function __toString()
    {
        return "<$this->tag>0</>";
    }
}
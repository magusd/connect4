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
use Connect4\Player\Exceptions\PieceNotSetException;

class BasePlayer
{
    protected $piece;
    public function setPiece(Piece $piece)
    {
        $this->piece = $piece;
    }

    public function getPiece()
    {
        if(!$this->piece) throw new PieceNotSetException();
        return $this->piece;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/12/18
 * Time: 6:45 AM
 */

namespace Connect4\Board\Events;


use Connect4\Board\Piece\Piece;

class WinnerWinnerChickenDinnerEvent
{
    protected $winner;
    public function __construct(Piece $winner)
    {
        $this->winner = $winner;
    }

    public function getWinner()
    {
        return $this->winner;
    }
}
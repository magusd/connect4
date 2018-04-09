<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/8/18
 * Time: 4:51 PM
 */

namespace Connect4\Player;


use Connect4\Board\BoardInterface;

interface PlayerInterface
{
    public function play(BoardInterface $board);
}
<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/12/18
 * Time: 5:44 AM
 */

namespace Connect4\Board\Rules;


use Connect4\Board\BoardInterface;

interface RuleInterface
{
    public function check(BoardInterface $board);
}
<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/12/18
 * Time: 5:44 AM
 */

namespace Connect4\Board\Rules;


use Connect4\Board\BoardInterface;

class FourInARowRule implements RuleInterface
{
    public function check(BoardInterface $board)
    {
        $mesh = $board->readBoard();

        for($i = 0; $i < $board->getRows() ; $i++){

        }
        //columns
        for ($j = $board->getStartIndex(); $j < $board->getEndIndex() ; $j++){
            //rows

        }

    }

    public function lookAhead($row,$column,$count = 1)
    {

    }
}
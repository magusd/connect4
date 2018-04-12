<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/12/18
 * Time: 5:44 AM
 */

namespace Connect4\Board\Rules;


use Connect4\Board\BoardInterface;
use Connect4\Board\Events\WinnerWinnerChickenDinnerEvent;
use Connect4\Board\Piece\Piece;

class FourInARowRule implements RuleInterface
{
    public function check(BoardInterface $board)
    {
        $mesh = $board->readBoard();
        //rows
        for($i = 0; $i < $board->getRows() ; $i++){
            //columns
            for ($j = $board->getStartIndex(); $j <= $board->getEndIndex() ; $j++){
                if(!$mesh[$i][$j]) continue;

                $result = $this->lookAhead($mesh,$i,$j);
                if($result) return new WinnerWinnerChickenDinnerEvent($result);
            }
        }
        return false;
    }

    public function lookAhead($mesh,$row,$column,$count = 1)
    {
        $piece = $mesh[$row][$column];

        if($count == 4) return $piece;

        //right
        $nextPiece = $mesh[$row][$column+1] ?? false;
        if($nextPiece && $nextPiece->getColor() == $piece->getColor()){
            return $this->lookAhead($mesh,$row,$column+1,$count+1);
        }

        //down
        $nextPiece = $mesh[$row+1][$column] ?? false;
        if($nextPiece && $nextPiece->getColor() == $piece->getColor()) {
            return $this->lookAhead($mesh, $row + 1, $column, $count + 1);
        }
        //diagonal
        $nextPiece = $mesh[$row+1][$column+1] ?? false;
        if($nextPiece && $nextPiece->getColor() == $piece->getColor()){
            return $this->lookAhead($mesh,$row+1,$column+1,$count+1);
        }
        return false;
    }
}
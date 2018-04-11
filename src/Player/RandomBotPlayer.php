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

class RandomBotPlayer extends BasePlayer implements PlayerInterface
{
    public function play(BoardInterface $board)
    {
        $range_start = $board->getStartIndex();
        $range_end = $board->getEndIndex();

        $move = false;
        $failed_attempts = 0;
        $column = null;
        while(!$move && $failed_attempts < $board->getColumns()){
            try{
                $column = random_int($range_start,$range_end);
                $board->addPiece($this->getPiece(),$column);
                $move = true;
            }catch (\Exception $e){
                var_dump($e->getMessage());
                var_dump(get_class($e));
                $failed_attempts++;
            }
        }
        return $column;
    }
}
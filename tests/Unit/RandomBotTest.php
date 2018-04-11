<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/8/18
 * Time: 3:25 PM
 */

namespace Tests\Unit;


use Connect4\Board\Piece\Piece;
use Connect4\Board\SimpleBoard;
use Connect4\Player\RandomBotPlayer;
use Tests\BaseTest;

class RandomBotTest extends BaseTest
{
    public function testPlayMoveReturnsMoveInfo()
    {
        $randomBot = new RandomBotPlayer();
        $randomBot->setPiece(new Piece('tag'));
        $board = new SimpleBoard();
        $move = $randomBot->play($board);

        $this->assertNotNull($move);
    }

    public function testBotMakesValidMove()
    {
        $randomBot = new RandomBotPlayer();
        $randomBot->setPiece(new Piece('tag'));

        $board = new SimpleBoard();
        $move = $randomBot->play($board);
        $mesh = $board->readBoard();

        $bottom_row = array_pop($mesh);

        $this->assertNotNull($bottom_row[$move]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/8/18
 * Time: 3:25 PM
 */

namespace Tests\Unit;


use Connect4\Board\Exceptions\BoardColumnIsFullException;
use Connect4\Board\Exceptions\InvalidColumnException;
use Connect4\Board\Piece\Piece;
use Connect4\Board\SimpleBoard;
use Tests\BaseTest;

class BoardTest extends BaseTest
{
    public function testBoardCreation()
    {
        $board = new SimpleBoard(6,7);

        $mesh = $board->readBoard();

        $this->assertEquals(6,count($mesh));
        $this->assertEquals(7,count(array_pop($mesh)));
    }

    public function testBoardAddPieceToValidPosition()
    {
        $board = new SimpleBoard(6,7);

        $piece = new Piece('blue');

        $board->addPiece($piece,4);
        $board->addPiece($piece,4);
        $board->addPiece($piece,4);
        $mesh = $board->readBoard();

        $this->assertEquals($piece,$mesh[6][4]);
        $this->assertEquals($piece,$mesh[5][4]);
        $this->assertEquals($piece,$mesh[4][4]);
        
    }

    public function testBoardAddPieceToFullColumn()
    {
        $board = new SimpleBoard(6,7);

        $piece = new Piece('blue');

        $this->expectException(BoardColumnIsFullException::class);
        for($i=0;$i<8;$i++)
            $board->addPiece($piece,4);

    }

    public function testBoardAddPieceToInvalidColumn()
    {
        $board = new SimpleBoard(6,7);

        $piece = new Piece('blue');

        $this->expectException(InvalidColumnException::class);

        $board->addPiece($piece,0);;

    }

    public function printBoard($mesh)
    {
        foreach ($mesh as $row) {
            foreach ($row as $piece) {
                echo $piece?$piece->getColor():'O';
            }
            echo PHP_EOL;
        }
    }
}
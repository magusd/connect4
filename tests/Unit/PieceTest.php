<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/8/18
 * Time: 3:25 PM
 */

namespace Tests\Unit;


use Connect4\Board\Piece\Piece;
use Tests\BaseTest;

class PieceTest extends BaseTest
{
    public function testPiece()
    {
        $piece = new Piece("blue");
        $this->assertEquals("blue",$piece->getColor());

        $piece2 = new Piece("red");
        $this->assertEquals("red",$piece2->getColor());
    }
}
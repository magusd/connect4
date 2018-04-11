<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/9/18
 * Time: 1:31 AM
 */

namespace Connect4\Board;


use Connect4\Board\Piece\Piece;

interface BoardInterface
{
    public function __construct($rows,$columns);
    public function readBoard();
    public function addPiece(Piece $piece, $column);
    public function getStartIndex();
    public function getEndIndex();
    public function getColumns();
}
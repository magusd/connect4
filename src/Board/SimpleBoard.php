<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/9/18
 * Time: 1:31 AM
 */

namespace Connect4\Board;


use Connect4\Board\Exceptions\BoardColumnIsFullException;
use Connect4\Board\Exceptions\InvalidColumnException;
use Connect4\Board\Piece\Piece;

class SimpleBoard implements BoardInterface
{
    protected $mesh;
    protected $rows;
    protected $columns;
    protected $startIndex;

    public function __construct($rows = 6,$columns = 7, $startIndex = 1)
    {
        $this->startIndex = $startIndex;
        $this->mesh = array_fill($startIndex, $rows, array_fill($startIndex, $columns, 0));
        $this->rows = $rows;
        $this->columns = $columns;
    }

    public function getStartIndex()
    {
        return $this->startIndex;
    }

    public function getEndIndex()
    {
        return $this->getColumns()+$this->getStartIndex()-1;
    }

    public function getColumns()
    {
        return $this->columns;
    }
    
    public function readBoard()
    {
        return $this->mesh;
    }

    public function addPiece(Piece $piece,$column)
    {
        $row = reset($this->mesh);
        if(!isset($row[$column])) throw new InvalidColumnException();

        for ($i = $this->rows ; $i > 0; $i--){
            if(!$this->mesh[$i][$column]) break;
        }



        if($i == 0) throw new BoardColumnIsFullException('no more space');

        $this->mesh[$i][$column] = $piece;
    }
}
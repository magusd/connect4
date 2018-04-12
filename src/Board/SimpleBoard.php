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
use Connect4\Board\Rules\FourInARowRule;

class SimpleBoard implements BoardInterface
{
    protected $mesh;
    protected $rows;
    protected $columns;
    protected $startIndex;
    protected $pieces = 0;
    protected $winner = false;
    protected $rules = [
      FourInARowRule::class
    ];

    public function __construct($rows = 6,$columns = 7)
    {
        $this->startIndex = 1;
        $this->mesh = array_fill(0, $rows, array_fill(1, $columns, 0));
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

    public function getRows()
    {
        return $this->rows;
    }
    
    public function readBoard()
    {
        return $this->mesh;
    }

    public function addPiece(Piece $piece,$column)
    {
        $row = reset($this->mesh);
        if(!isset($row[$column])) throw new InvalidColumnException();

        for ($i = $this->rows-1 ; $i >= 0; $i--){
            if(!$this->mesh[$i][$column]) break;
        }

        if($i < 0) throw new BoardColumnIsFullException('no more space');

        $this->pieces++;

        $this->mesh[$i][$column] = $piece;

        $this->checkRules();

    }

    public function checkRules()
    {
        $events = [];
        foreach ($this->rules as $rule){
            $object = new $rule;
            $event = $object->check($this);
            if($event) array_merge($events,$event);
        }
    }
    public function gameOver()
    {
        $boardIsFull = ($this->rows*$this->columns) == $this->pieces;
        $boardHasWinner = ($this->getWinner() !== false);
        return  $boardIsFull || $boardHasWinner;
    }

    public function getWinner()
    {
        return false;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/9/18
 * Time: 1:33 AM
 */

namespace Connect4\Board\Piece;


class Piece
{
    protected $tag;
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public function getColor()
    {
        return $this->tag;
    }
}
<?php

namespace ArcheeNic\Likesoft\Math;

class MathMinus extends MathAbstract
{
    protected $type = 'minus';

    protected function math(array $row): int
    {
        return $row[0] - $row[1];
    }
}

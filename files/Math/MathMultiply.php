<?php

namespace ArcheeNic\Likesoft\Math;

class MathMultiply extends MathAbstract
{
    protected $type = 'multiply';

    protected function math(array $row): int
    {
        return $row[0] * $row[1];
    }
}

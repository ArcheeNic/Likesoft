<?php

namespace ArcheeNic\Likesoft\Math;

class MathPlus extends MathAbstract
{
    protected $type = 'plus';

    protected function math(array $row): int
    {
        return $row[0] + $row[1];
    }
}

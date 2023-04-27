<?php

namespace ArcheeNic\Likesoft\Math;

class MathDivision extends MathAbstract
{
    protected $type = 'division';

    protected function executeRow(?array $row): void
    {
        $line = $this->prepareRow($row);

        if ($line[1] === 0) {
            $this->errorNotAllowed($line);

            return;
        }

        $result = $this->math($line);
        $this->saveResult($result, $line);
    }

    protected function math(array $row): int
    {
        return $row[0] / $row[1];
    }

    private function errorNotAllowed($line): void
    {
        $message = "numbers are %s and %s are wrong, is not allowed";
        $this->log->info(sprintf($message, ...$line));
    }
}

<?php

namespace ArcheeNic\Likesoft\Math;

use ArcheeNic\Likesoft\Csv\CsvReader;
use ArcheeNic\Likesoft\Csv\CsvWriter;
use ArcheeNic\Likesoft\Logger;

abstract class MathAbstract
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var CsvReader
     */
    protected $readFile;
    /**
     * @var CsvWriter
     */
    protected $writeFile;
    /**
     * @var Logger
     */
    protected $log;

    protected $verbose = false;

    public function __construct(CsvReader $readFile, CsvWriter $writeFile, Logger $log)
    {
        $this->readFile  = $readFile;
        $this->writeFile = $writeFile;
        $this->log       = $log;
    }

    protected function errorWrong($line): void
    {
        $message = "numbers are - %s and %s are wrong";
        $this->log->info(sprintf($message, ...$line));
    }

    protected function prepareRow(?array $row): array
    {
        if (!$row) {
            return [0, 0];
        }

        $left  = (int)trim($row[0] ?? 0);
        $right = (int)trim($row[1] ?? 0);

        return [$left, $right];
    }

    protected function saveResult($result, $row): void
    {
        if ($result < 0) {
            $this->errorWrong($row);

            return;
        }

        $row[] = $result;
        $this->writeFile->push($row);
    }

    public function execute(): void
    {
        $this->writeFile->clean();
        while (($row = $this->readFile->getRow(1000)) !== false) {
            if ($this->verbose) {
                $this->log->info("Started $this->type operation");
            }

            $this->executeRow($row);

            if ($this->verbose) {
                $this->log->info("Finished $this->type operation");
            }
        }
    }

    protected function executeRow(?array $row): void
    {
        $row    = $this->prepareRow($row);
        $result = $this->math($row);
        $this->saveResult($result, $row);
    }

    abstract protected function math(array $row): int;
}

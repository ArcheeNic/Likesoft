<?php

namespace ArcheeNic\Likesoft\Math;

use ArcheeNic\Likesoft\Csv\CsvReader;
use ArcheeNic\Likesoft\Csv\CsvWriter;
use ArcheeNic\Likesoft\LikesoftException;
use ArcheeNic\Likesoft\Logger;

class MathFactory
{
    public function getFromAction(
        string $action,
        CsvReader $reader,
        CsvWriter $writer,
        Logger $logger
    ) {
        switch ($action) {
            case 'plus':
                return new MathPlus($reader, $writer, $logger);
            case 'minus':
                return new MathMinus($reader, $writer, $logger);
            case 'multiply':
                return new MathMultiply($reader, $writer, $logger);
            case 'division':
                return new MathDivision($reader, $writer, $logger);
            default:
                throw new LikesoftException("Wrong action is selected");
        }
    }
}

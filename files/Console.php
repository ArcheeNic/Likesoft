<?php

namespace ArcheeNic\Likesoft;

use ArcheeNic\Likesoft\Csv\CsvReader;
use ArcheeNic\Likesoft\Csv\CsvWriter;
use ArcheeNic\Likesoft\Math\MathDivision;
use ArcheeNic\Likesoft\Math\MathFactory;
use ArcheeNic\Likesoft\Math\MathMinus;
use ArcheeNic\Likesoft\Math\MathMultiply;
use ArcheeNic\Likesoft\Math\MathPlus;
use RuntimeException;

class Console
{

    /**
     * @var array|null
     */
    private $options;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger, ?array $options = null)
    {
        $this->options = $options;
        $this->logger  = $logger;

        if ($this->options === null) {
            $this->loadOptions();
        }
    }

    private function loadOptions(): void
    {
        $shortOpts = "a:f:";
        $longOpts  = [
            "action:",
            "file:",
        ];

        $this->options = getopt($shortOpts, $longOpts);
    }

    private function getAction(): string
    {
        return $this->options['a'] ?? $this->options['action'] ?? "xyz";
    }

    private function getFile(): string
    {
        return $this->options['f'] ?? $this->options['file'] ?? "notexists.csv";
    }

    public function execute(string $path): void
    {
        $action = $this->getAction();
        $file   = $this->getFile();
        $reader = new CsvReader($path . '/' . $file);
        $writer = new CsvWriter($path . '/result.csv');
        $logger = $this->logger;
        (new MathFactory())->getFromAction($action, $reader, $writer, $logger)->execute();
    }

}

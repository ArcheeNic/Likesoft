<?php

namespace ArcheeNic\Likesoft;

class Logger
{
    private $filePath;
    private $delimiter;

    /**
     * @param  string  $fileName
     * @param  string  $delimiter
     */
    public function __construct(string $fileName, string $delimiter = "\n")
    {
        $this->filePath  = $fileName;
        $this->delimiter = $delimiter;
    }

    public function info(string $message): void
    {
        file_put_contents($this->filePath, $message . $this->delimiter, FILE_APPEND);
    }

    public function error($message, array $context): void
    {
        file_put_contents(
            $this->filePath,
            'ERROR: ' . $message . $this->delimiter . var_export($context, true) . $this->delimiter,
            FILE_APPEND
        );
    }

    public function clear(): void
    {
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }
}

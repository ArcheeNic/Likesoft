<?php

namespace ArcheeNic\Likesoft\Csv;

use ArcheeNic\Likesoft\LikesoftException;

class CsvDriver
{
    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var ?resource
     */
    protected $handle = null;

    /**
     * @var string
     */
    protected $separator;

    /**
     * @var string
     */
    protected $enclosure;

    /**
     * @var string
     */
    protected $escape;

    protected $checkReadable = false;

    public function __construct(
        string $fileName,
        string $separator = ";",
        string $enclosure = "\"",
        string $escape = "\\"
    ) {
        $this->checkIsNotDirectory($fileName);
        $this->filePath  = $fileName;
        $this->separator = $separator;
        $this->enclosure = $enclosure;
        $this->escape    = $escape;
    }

    public function __destruct()
    {
        $this->close();
    }

    protected function checkIsNotDirectory($fileName): void
    {
        if (is_dir($fileName)) {
            throw new LikesoftException('Path file is directory: ' . $fileName);
        }
    }

    public function close(): bool
    {
        if ($this->handle) {
            return fclose($this->handle);
        }

        return false;
    }
}

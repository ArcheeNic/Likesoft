<?php

namespace ArcheeNic\Likesoft\Csv;

use ArcheeNic\Likesoft\LikesoftException;

class CsvReader extends CsvDriver
{
    protected $checkReadable = false;

    public function open(): void
    {
        $this->validateReadable();
        $this->handle = fopen($this->filePath, 'r');
    }

    public function getRow(?string $length = null)
    {
        if (!$this->handle) {
            $this->open();
        }

        return fgetcsv($this->handle, $length, $this->separator, $this->enclosure, $this->escape);
    }

    private function validateReadable(): void
    {
        if ($this->checkReadable) {
            return;
        }

        if (!file_exists($this->filePath)) {
            throw new LikesoftException("Please define file with data");
        }

        if (!is_readable($this->filePath)) {
            throw new LikesoftException("We have not rights to read this file");
        }
        $this->checkReadable = true;
    }
}

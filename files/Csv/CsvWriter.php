<?php

namespace ArcheeNic\Likesoft\Csv;

class CsvWriter extends CsvDriver
{
    public function open(): void
    {
        $this->handle = fopen($this->filePath, 'a');
    }

    public function clean(): void
    {
        $this->close();
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }

    public function push(array $content): void
    {
        if (!$this->handle) {
            $this->open();
        }
        fputcsv(
            $this->handle,
            $content,
            $this->separator,
            $this->enclosure,
            $this->escape
        );
    }
}

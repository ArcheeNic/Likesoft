<?php
use ArcheeNic\Likesoft\Console;
use ArcheeNic\Likesoft\Logger;

require_once('loader.php');

unlink(__DIR__ . '/log.txt');
$logger = new Logger(__DIR__ . '/log.txt');

try {
    (new Console($logger))->execute(__DIR__);
} catch (Exception $e) {
    $logger->error($e->getMessage(), $e->getTrace());
}

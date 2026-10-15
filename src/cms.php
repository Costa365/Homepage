<?php
declare(strict_types=1);

class cms {
    public static function readContent($content) {
        $json = file_get_contents(__DIR__ . '/content/sites.json');
        return json_decode($json, true) ?: [];
    }
}

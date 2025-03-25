<?php
namespace App;

function log_json(array $data): void
{
    echo "\n" . json_encode($data, JSON_UNESCAPED_SLASHES) . "\n";
}

<?php
namespace App;

require_once __DIR__ . '/ParamParser.php';
require_once __DIR__ . '/Logger.php';

use function App\parse_param;
use function App\log_json;

function handle_root(array $params): void
{
    $start = microtime(true);

    $wait = parse_param($params['wait'] ?? '0', 'float', 0.0);
    $status = parse_param($params['status'] ?? '200', 'int', 200);
    $size = parse_param($params['response_size'] ?? '100', 'int', 100);

    if ($wait > 0) {
        usleep((int) ($wait * 1_000_000));
    }

    http_response_code($status);
    header('Content-Type: application/json');

    $response = [
        'status' => $status,
        'wait' => $wait,
        'response_size' => $size,
        'payload' => str_repeat('X', $size)
    ];

    echo json_encode($response);

    log_json([
        'timestamp' => gmdate('c'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'method' => $_SERVER['REQUEST_METHOD'],
        'path' => $_SERVER['REQUEST_URI'],
        'params' => $params,
        'status' => $status,
        'wait' => $wait,
        'response_size' => $size
    ]);
}

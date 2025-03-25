<?php
namespace App;

require_once __DIR__ . '/Handler.php';

class Router
{
    public function handle(string $uri, array $params): void
    {
        // Unique route "/"
        if (parse_url($uri, PHP_URL_PATH) === '/') {
            handle_root($params);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Not Found']);
        }
    }
}

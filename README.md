# PHP JSON Test Server

This is a simple JSON HTTP test server written in PHP.
It simulates delays, HTTP status codes, and custom response sizes.
Useful for testing proxies, timeouts, and HTTP clients.

---

## Quick Start

### Requirements

- PHP 8+
- `make` (optional but recommended)

### Run server (default: port 8080)

```bash
PORT=8080 make run
```

Or manually:

```bash
php -S localhost:8080 -t public
```

---

## Query Parameters

| Parameter       | Description                              | Examples                           |
|-----------------|------------------------------------------|------------------------------------|
| `wait`          | Delay before response (seconds or float) | `1`, `0.5`, `0.1-1.5`, `0.2,0.5,1` |
| `status`        | HTTP status code                         | `200`, `404`, `200-299`, `200,404` |
| `response_size` | Response body size in bytes/K/M/G        | `100`, `1K`, `10K-20K`, `1K,2K,3K` |

- You can pass **single values**, **ranges** (`min-max`) or **lists** (`val1,val2,...`).
- Units supported: `B`, `K`, `M`, `G`

---

## Example `curl` Requests

```bash
curl "http://localhost:8080?wait=0.5&status=200-299&response_size=5K"
```

```bash
curl "http://localhost:8080?status=404&response_size=2K"
```

```bash
curl "http://localhost:8080?wait=0.1,0.5,1&status=500&response_size=10K"
```

---

## Makefile Commands

```bash
make run           # Start server on port 8080
```

---

## Project Structure

```
php-app/
├── public/             # Web root (index.php)
├── src/                # Application logic
│   ├── Handler.php     # Request handler
│   ├── Router.php      # Request router
│   ├── ParamParser.php # Query parameter parser
│   └── Logger.php      # Custom logger
├── Makefile
└── README.md
```


<?php
// Build PDO connection from environment variables with safe defaults
function env_or_default($key, $default) {
    $v = getenv($key);
    if ($v === false || $v === '') {
        $v = $_ENV[$key] ?? $_SERVER[$key] ?? $default;
    }
    return $v;
}

$driver = env_or_default('DB_CONNECTION', 'mysql');
$host = env_or_default('DB_HOST', '127.0.0.1'); // use TCP by default to avoid socket issues
$port = env_or_default('DB_PORT', '3306');
$dbname = env_or_default('DB_DATABASE', 'question');
$username = env_or_default('DB_USERNAME', 'root');
$password = env_or_default('DB_PASSWORD', '');

$dsn = $driver . ":host=" . $host . ";port=" . $port . ";dbname=" . $dbname . ";charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo "Connection failed: " . $e->getMessage();
    exit();
}

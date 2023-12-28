<?php
require __DIR__ .'/vendor/autoload.php';
\Mehdi\Core\DB\DB::getConn()->query("
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

\Mehdi\Core\DB\DB::getConn()->query("
CREATE TABLE IF NOT EXISTS url_shortener (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    long_url VARCHAR(255) NOT NULL,
    short_code VARCHAR(50) NOT NULL UNIQUE,
    `usage` INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);");

\Mehdi\Core\DB\DB::getConn()->query('
INSERT INTO users (username, password) VALUES("mehdints", "$2y$10$oy5BBdlv109bguiWf1hWYOV0LTPhEtdsuz.6c0zH4T5f7w3NDgxpi");');
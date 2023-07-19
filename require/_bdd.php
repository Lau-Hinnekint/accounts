<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    $dbCo = new PDO(
        $_ENV['DATABASE_DNS'],
        $_ENV['DATABASE_USER'],
        $_ENV['DATABASE_PASSWORD']
    );

    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}

catch (Exception $e) {
    die('Unable to connect to the database.'.$e->getMessage());
}

?>
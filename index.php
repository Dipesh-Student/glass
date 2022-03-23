<?php 

require_once realpath('vendor/autoload.php');

// Looing for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//header("Location: /public/");
echo "root";
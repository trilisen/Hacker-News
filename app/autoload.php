<?php

declare(strict_types=1);

// Start the session engines.
session_start();

// Set the default timezone to coordinated universal time.
date_default_timezone_set('UTC');

// Include the helper functions.
require __DIR__ . '/functions.php';

// Fetch the global configuration array.
$config = require __DIR__ . '/config.php';

// Setup the database connection.
$pdo = new PDO($config['database_path']);

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
} // Go through code and add errors, do like if($_SESSION['errors']['this_error']){<p>Yo stop dude</p>}

<?php
// Name - Gabriel Hlaing
// Version - 26/03/2025
// Description - Establishes database connection for Zippy Used Autos.

$dsn = 'mysql:host=localhost;dbname=zippyusedautos';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = "Database Connection Error: " . $e->getMessage();
    include('../view/error.php');
    exit();
}

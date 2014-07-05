<?php

/*
 * DSN & PDO
*/
$dsn = 'mysql:host=localhost;port=8888;dbname=cdxlogin';
$username='root';
$password='root';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('dbError.inc');
    exit();
}

?>

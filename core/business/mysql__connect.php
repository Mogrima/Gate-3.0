<?php
// require_once ('../connectvars.php');
$host = 'localhost';
// $db = 'u95146cn_gate';
$db = 'gate';
$user = 'root';
// $dbpass = 'kwvayHhG';
$dbpass = '';

// подключение к базе данных
// $dsn = 'mysql:host=localhost;dbname=u95146cn_gate;charset=utf8';
// $pdo = new PDO($dsn, 'u95146cn_gate', 'kwvayHhG'); 

$dsn = 'mysql:host=localhost;dbname=gate;charset=utf8';
$pdo = new PDO($dsn, 'root', '');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>
<?php

header('Content-Type: text/html; charset=utf-8'); 

$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "test";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

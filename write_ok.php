<?php
session_start();
include('UserDB.php');
if (isset($_SERVER["REQUEST_METHOD"])) {

    // Include your database connection file

    // Get form data
    $board_title = $_POST["board_title"];
    $board_name = $_SESSION["user_name"];
    $board_content = $_POST["board_content"];
    $board_password = "";
    // Get the current date
    $board_date = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO board (board_name, board_password, board_title, board_content, board_date) VALUES (?, ?,?, ?, ?)");

    $stmt->bind_param("sssss", $board_name, $board_password, $board_title, $board_content, $board_date); 
    if ($stmt->execute()) {
        echo "<script>
        alert('글 작성이 완료되었습니다.');
        location.href='CheckRegist.php';</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $conn->close();
}
?>

<?php
session_start();
include('UserDB.php');
if (isset($_SERVER["REQUEST_METHOD"])) {

    // Include your database connection file

    // Get form data
    $review_title = $_POST["review_title"];
    $review_name = $_SESSION["user_name"];
    $review_content = $_POST["review_content"];
    $review_password = "";
    // Get the current date
    $review_date = date("Y-m-d");
    $stmt = $conn->prepare("INSERT INTO review (review_name, review_password, review_title, review_content, review_date) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $review_name, $review_password, $review_title, $review_content, $review_date); 
    if ($stmt->execute()) {
        echo "<script>
        alert('리뷰 작성이 완료되었습니다.');
        location.href='CheckReview.php';</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $conn->close();
}
?>

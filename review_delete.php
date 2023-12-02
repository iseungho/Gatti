<?php
session_start();

include('UserDB.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle unauthorized access

    header("Location: mainlogin_view.php");
    exit();
}

// Get the review index from the URL
$bno = $_GET['review_idx'];

// Fetch the post details from the database
$sql = "SELECT * FROM review WHERE review_idx='$bno'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check if the logged-in user is the creator of the post
    if ($_SESSION['user_name'] == $row['review_name']) {
        // User is authorized to delete the post
        $deleteSql = "DELETE FROM review WHERE review_idx='$bno'";
        if ($conn->query($deleteSql) === TRUE) {
            echo '<script type="text/javascript">alert("삭제되었습니다.");</script>';
            header("refresh:0; url=CheckReview.php?after");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // User is not authorized to delete the post
        echo '<script type="text/javascript">alert("권한이 없습니다.");</script>';
        header("refresh:0; url=CheckReview.php?after");
        exit();
    }
} else {
    echo "Post not found";
}

$conn->close();
?>

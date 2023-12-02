<?php
include('UserDB.php');

function resetNum($AppointmentID) {
    global $conn;

    $resetQuery = "UPDATE appointmentmenu SET Num = 0 WHERE AppointmentID = '$AppointmentID'";
    $resetResult = $conn->query($resetQuery);

    if (!$resetResult) {
        die("쿼리 실행 실패: " . $conn->error);
    }

    // Return a response (you can customize this based on your needs)
    echo json_encode(['status' => 'success', 'message' => 'Quantities reset successfully']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] ?? '' == "POST" && isset($_POST['reset'])) {
    $AppointmentID = $_POST['AppointmentID'];
    resetNum($AppointmentID);
}


// Handle other cases or provide appropriate responses if needed
echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
exit;
?>

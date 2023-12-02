<?php
include 'config.php';

// 약속 생성 함수
function createAppointment($restaurantID, $userID, $numOfPeople, $menu, $status, $date, $time)
{
    global $conn;

    $query = "INSERT INTO Appointment (RestaurantID, UserID, NumOfPeople, Menu, AppointmentStatus, Date, Time)
              VALUES (:restaurantID, :userID, :numOfPeople, :menu, :status, :date, :time)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':restaurantID', $restaurantID);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':numOfPeople', $numOfPeople);
    $stmt->bindParam(':menu', $menu);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// 약속 조회 함수
function getAppointmentsByUserID($userID)
{
    global $conn;

    $query = "SELECT * FROM Appointment WHERE UserID = :userID";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// 사용 예시
$restaurantID = 1;
$userID = 2;
$numOfPeople = 4;
$menu = "Special Menu";
$status = "Pending";
$date = "2023-11-17";
$time = "12:00:00";

if (createAppointment($restaurantID, $userID, $numOfPeople, $menu, $status, $date, $time)) {
    echo "Appointment created successfully!";
} else {
    echo "Failed to create appointment.";
}

// 약속 조회 및 출력
$appointments = getAppointmentsByUserID($userID);

foreach ($appointments as $appointment) {
    echo "Appointment ID: " . $appointment['AppointmentID'] . "<br>";
    echo "Restaurant ID: " . $appointment['RestaurantID'] . "<br>";
    echo "Num of People: " . $appointment['NumOfPeople'] . "<br>";
    echo "Menu: " . $appointment['Menu'] . "<br>";
    echo "Status: " . $appointment['AppointmentStatus'] . "<br>";
    echo "Date: " . $appointment['Date'] . "<br>";
    echo "Time: " . $appointment['Time'] . "<br>";
    echo "<hr>";
}
?>

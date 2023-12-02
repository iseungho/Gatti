<?php
include('UserDB.php');

session_start(); /* 세션 시작 */

require_once 'connection.php'; // 데이터베이스 연결 파일

/* 사용자 정보 가져오기 */
$user_id = $_SESSION['user']['user_id'];
$username = $_SESSION['user']['username'];

/* 친구 목록 가져오기 */
$friends = getFriendList($user_id);

function getFriendList($user_id) {
    global $conn;

    $query = "SELECT appointment_user_id FROM appointment WHERE user_id = ?";

    if ($stmt = $conn->query($query)) {

        $stmt->bind_param("s", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $friends = array();

        while ($row = $result->fetch_assoc()) {
            $friends[] = $row['appointment_user_id'];
        }

        return $friends;
    } else {
 
        die("Failed to execute query: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>우리 함께 밥먹을래?</title>
    <!-- 사이트 아이콘-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
        rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <h2>오늘은 누구랑 먹을까?</h2>

    <h4><?php echo $username; ?>님의 밥친구</h4>
    <ul>
        <?php foreach ($friends as $friend): ?>
            <li><?php echo $friend; ?></li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
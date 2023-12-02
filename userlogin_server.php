<?php

include('UserDB.php');

if (isset($_POST['user_id']) && isset($_POST['pass1'])) {

    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);

    if (empty($user_id)) {
        header("location: userlogin_view.php?error=아이디가 비어있어요");
        exit();
    } else if (empty($pass1)) {
        header("location: userlogin_view.php?error=비밀번호가 비어있어요");
        exit();
    } else {

        $sql = "select * from user where user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hash = $row['user_password'];

            if (password_verify($pass1, $hash)) {
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                echo '<script>';
                echo 'alert("어서오세요! Gatti 할까요?");';
                echo 'window.location.href = "index.php?success=login";';
                echo '</script>';
                exit();
            } else {
                header("location: userlogin_view.php?error=비밀번호가 일치하지 않아요");
                exit();
            }
        } else {
            header("location: userlogin_view.php?error=회원정보가 없습니다");
            exit();
        }
    }
} else {
    header("location: userlogin_view.php?error=알수없는 오류발생 (담당자에게 문의주세요)");
    exit();
}
?>
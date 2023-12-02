<?php
    session_start();
    include('UserDB.php');
    

    $bno = $_GET['board_idx'];
    $userpw ="";
    
    if($bno && $_SESSION['user_name'] && $_POST['reply_content']){
        $sql = $conn->query("INSERT into reply(reply_con_num,reply_name,reply_password,reply_content) values('".$bno."','".$_SESSION['user_name']."','".$userpw."','".$_POST['reply_content']."')");
        echo "
        <script>alert('댓글이 작성되었습니다.'); 
        location.href='read.php?board_idx=$bno';</script>";
    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    }
?>
<?php
include('UserDB.php');
echo($_GET['board_idx']);
$bno = $_GET['board_idx'];
$username = $_POST['board_name'];
$userpw = "";
$title = $_POST['board_title'];
$content = $_POST['board_content'];
$sql = $conn->query("UPDATE board set board_name='".$username."',board_password='".$userpw."',board_title='".$title."',board_content='".$content."' where board_idx='".$bno."'"); ?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<meta http-equiv="refresh" content="0 url=CheckRegist.php">
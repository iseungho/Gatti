<?php
include('UserDB.php');
echo($_GET['review_idx']);
$bno = $_GET['review_idx'];
$username = $_POST['review_name'];
$userpw = "";
$title = $_POST['review_title'];
$content = $_POST['review_content'];
$sql = $conn->query("UPDATE review set review_name='".$username."',review_password='".$userpw."',review_title='".$title."',review_content='".$content."' where review_idx='".$bno."'"); ?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<meta http-equiv="refresh" content="0 url=CheckReview.php">
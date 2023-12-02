<?php
	include('UserDB.php');
   
	$bno = $_GET['board_idx'];
    $thumbup = mysqli_fetch_array($conn->query("SELECT board_thumbup from board where board_idx='$bno';"));
    $thumbup = $thumbup['board_thumbup'] + 1;
    $conn->query("UPDATE board set board_thumbup=".$thumbup." where board_idx=".$bno.";");
    ?>
    <script type="text/javascript">alert("추천되었습니다.");</script>
    <meta http-equiv="refresh" content="0 url=CheckRegist.php" />
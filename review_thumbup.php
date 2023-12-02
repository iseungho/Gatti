<?php
	include('UserDB.php');
   
	$bno = $_GET['review_idx'];
    $thumbup = mysqli_fetch_array($conn->query("SELECT review_thumbup from review where review_idx='$bno';"));
    $thumbup = $thumbup['review_thumbup'] + 1;
    $conn->query("UPDATE review set review_thumbup=".$thumbup." where review_idx=".$bno.";");
    ?>
    <script type="text/javascript">alert("추천되었습니다.");</script>
    <meta http-equiv="refresh" content="0 url=CheckReview.php" />
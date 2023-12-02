<?php
include('UserDB.php');

$sql = $conn->query("SELECT * FROM board ORDER BY board_idx DESC LIMIT 0, 10");
echo ($sql);

?>
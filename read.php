<?php
session_start();
include('UserDB.php');

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to a login page or show an error message
    header("Location: mainlogin_view.php");
    exit();
}
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
</head>
<body>
    <h1><a href="CheckRegist.php">약속게시판</a></h1>
    <?php
        $bno = isset($_GET['board_idx']) ? intval($_GET['board_idx']) : 0;

        // Check if $bno is a valid positive integer
        if ($bno > 0) {
            $hit = mysqli_fetch_array($conn->query("SELECT * FROM board WHERE board_idx = '".$bno."' LIMIT 1"));
            
            if ($hit) {
                $hit = $hit['board_hit'] + 1;
                $fet = $conn->query("UPDATE board SET board_hit = '".$hit."' WHERE board_idx = '".$bno."' LIMIT 1");
                
                $sql = $conn->query("SELECT * FROM board WHERE board_idx='".$bno."' LIMIT 1");
                $board = $sql->fetch_array();
                
                if ($board) {
                    ?>
                    <!-- 글 불러오기 -->
                    <div id="board_read">
                        <h2><?php echo $board['board_title']; ?></h2>
                        <div id="user_info">
                            <?php echo $board['board_name']; ?> <?php echo $board['board_date']; ?> 조회:<?php echo $board['board_hit']; ?>
                            <div id="bo_line"></div>
                        </div>
                        <div id="bo_content">
                            <?php echo nl2br($board['board_content']); ?>
                        </div>
                        <!-- 목록, 수정, 삭제 -->
                        <div id="bo_ser">
                            <ul>
                                <li><a href="CheckRegist.php">[목록으로]</a></li>
                                <li><a href="thumbup.php?board_idx=<?php echo $board['board_idx']; ?>">[추천]</a></li>
                                <li><a href="modify.php?board_idx=<?php echo $board['board_idx']; ?>">[수정]</a></li>
                                <li><a href="delete.php?board_idx=<?php echo $board['board_idx']; ?>">[삭제]</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--- 댓글 불러오기 -->
<div class="reply_view">
	<h3>댓글목록</h3>
		<?php
			$sql3 = $conn->query("SELECT * from reply where reply_con_num='".$bno."' order by board_idx desc");
			while($reply = $sql3->fetch_array()){ 
		?>
		<div class="dap_lo">
			<div><b><?php echo $reply['reply_name'];?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$reply[reply_content]"); ?></div>
			<div class="rep_me dap_to"><?php echo $reply['reply_date']; ?></div>
			<div class="rep_me rep_menu">
			</div>

			<div class="dat_edit">
				<form method="post" action="/reply_modify_ok.php">
					<input type="hidden" name="reply_rno" value="<?php echo $reply['board_idx']; ?>" />
                    <input type="hidden" name="reply_b_no" value="<?php echo $bno; ?>">
					<input type="password" name="reply_password" class="dap_sm" placeholder="비밀번호" />
					<textarea name="reply_content" class="dap_edit_t"><?php echo $reply['reply_content']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
			</div>
			<div class='dat_delete'>
				<form action="reply_delete.php" method="post">
					<input type="hidden" name="reply_rno" value="<?php echo $reply['board_idx']; ?>" />
                    <input type="hidden" name="reply_b_no" value="<?php echo $bno; ?>">
			 		<p><input type="password" name="reply_password" /> <input type="submit" value="확인"></p>
				 </form>
			</div>
            
		</div>
	<?php } ?>

	<!--- 댓글 입력 폼 -->
	<div class="dap_ins">
		<form action="reply_ok.php?board_idx=<?php echo $bno; ?>" method="post">
			<div style="margin-top:10px; ">
				<textarea name="reply_content" class="reply_content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt">댓글</button>
			</div>
		</form>
	</div>
</div><!--- 댓글 불러오기 끝 -->
<div id="foot_box"></div>
</div>
</body>
</html>
                    <?php
                } else {
                    echo '게시글을 찾을 수 없습니다.';
                }
            } else {
                echo '게시글을 찾을 수 없습니다.';
            }
        } else {
            echo '올바르지 않은 게시글 인덱스입니다.';
        }
    ?>
</body>
</html>

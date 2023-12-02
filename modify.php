<!--- 게시글 수정 -->
<?php
include('UserDB.php');
   
	$bno = $_GET['board_idx'];
	$sql = $conn->query("SELECT * from board where board_idx='$bno';");
	$board = $sql->fetch_array();
 ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" href="/css/style.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href="/">자유게시판</a></h1>
        <h4>글을 수정합니다.</h4>
            <div id="write_area">
                <form action="modify_ok.php?board_idx=<?php echo $bno; ?>" method="post">
                    <div id="in_title">
                        <textarea name="board_title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $board['board_title']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="board_name" id="uname" rows="1" cols="55" placeholder="글쓴이" maxlength="100" required><?php echo $board['board_name']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="board_content" id="ucontent" placeholder="내용" required><?php echo $board['board_content']; ?></textarea>
                    </div>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
session_start();
include('UserDB.php');
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
    <h1><a href="CheckReview.php">Review Board</a></h1>
    <?php
        $bno = isset($_GET['review_idx']) ? intval($_GET['review_idx']) : 0;

        // Check if $bno is a valid positive integer
        if ($bno > 0) {
            $hit = mysqli_fetch_array($conn->query("SELECT * FROM review WHERE review_idx = '".$bno."' LIMIT 1"));
            
            if ($hit) {
                $hit = $hit['review_hit'] + 1;
                $fet = $conn->query("UPDATE review SET review_hit = '".$hit."' WHERE review_idx = '".$bno."' LIMIT 1");
                
                $sql = $conn->query("SELECT * FROM review WHERE review_idx='".$bno."' LIMIT 1");
                $review = $sql->fetch_array();
                
                if ($review) {
                    ?>
                    <!-- 글 불러오기 -->
                    <div id="board_read">
                        <h2><?php echo $review['review_title']; ?></h2>
                        <div id="user_info">
                            <?php echo $review['review_name']; ?> <?php echo $review['review_date']; ?> 조회:<?php echo $review['review_hit']; ?>
                            <div id="bo_line"></div>
                        </div>
                        <div id="bo_content">
                            <?php echo nl2br($review['review_content']); ?>
                        </div>
                        <!-- 목록, 수정, 삭제 -->
                        <div id="bo_ser">
                            <ul>
                                <li><a href="CheckReview.php">[목록으로]</a></li>
                                <li><a href="review_thumbup.php?review_idx=<?php echo $review['review_idx']; ?>">[추천]</a></li>
                                <li><a href="review_modify.php?review_idx=<?php echo $review['review_idx']; ?>">[수정]</a></li>
                                <li><a href="review_delete.php?review_idx=<?php echo $review['review_idx']; ?>">[삭제]</a></li>
                            </ul>
                        </div>
                    </div>
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

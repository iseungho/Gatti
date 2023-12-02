<?php
session_start();
include('UserDB.php');
if (isset($_SESSION["user_id"])) {
    $userid=$_SESSION["user_id"];
    $username=$_SESSION["user_name"];
    $loginLink="mypage.php";
} else {

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Board</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <style>
        .pagination {
            display: inline-block;
            padding: 8px;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }
    </style>
</head>



<div id="board_area">
    <h1><a href="index.php">Gatti</a></h1>
    <h4>For the Review</h4>


    </table>

    <div id="search_box">
    <a href="<?php echo $loginLink; ?>" class = "logBtn"><?php echo $username; ?> 님</a>
        <form action = "search_result_review.php" method="get">
            <select name="catgo">
                <option value="review_title">제목</option>
                <option value="review_name">글쓴이</option>
                <option value="review_content">내용</option>
            </select>
            <input type="text" name="search" size="40" required="required"/> <button>Search</button>
        </form>
    </div>





    <table class="list-table">
        <thead>
        <tr>
            <th width="500">제목</th>
            <th width="120">글쓴이</th>
            <th width="100">작성일</th>
            <th width="100">조회수</th>
            <th width="100">추천수</th>
        </tr>
        </thead>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        // Fetch the total number of rows
        $sql_total = $conn->query("SELECT COUNT(*) as total FROM review");
        $total_rows = $sql_total->fetch_assoc()['total'];

        $list = 10; // Number of items to display per page
        $total_page = ceil($total_rows / $list);

        // Calculate the start index for the current page
        $start_num = ($page - 1) * $list;

        // Fetch data for the current page
        $sql_page = $conn->query("SELECT * FROM review ORDER BY review_idx DESC LIMIT $start_num, $list");

        if (!$sql_page) {
            die("Error in SQL query: " . $conn->error);
        }

        while ($review = $sql_page->fetch_array()) {
            $title = $review["review_title"];
            if (strlen($title) > 30) {
                $title = str_replace($review["review_title"], mb_substr($review["review_title"], 0, 30, "utf-8") . "...", $review["review_title"]);
            }
            ?>
            <tbody>
            <tr>
                <td width="500"><a href="review_read.php?review_idx=<?php echo $review["review_idx"];?>"><?php echo $title; ?></a></td>
                <td width="120"><?php echo $review['review_name']; ?></td>
                <td width="100"><?php echo $review['review_date']; ?></td>
                <td width="100"><?php echo $review['review_hit']; ?></td>
                <!-- 추천수 표시해주기 위해 추가한 부분 -->
                <td width="100"><?php echo $review['review_thumbup']; ?></td>
            </tr>
            </tbody>
            <?php
        }

        // Calculate block start and end numbers
        $block_ct = 5; // Number of page links to display in each block
        $block_num = ceil($page / $block_ct);
        $block_start = ($block_num - 1) * $block_ct + 1;
        $block_end = min($block_start + $block_ct - 1, $total_page);

        // Ensure $block_start is not less than 1
        $block_start = max($block_start, 1);
        ?>

    </table>

    <!-- Pagination links -->
    <div class="pagination">
        <?php
        if ($page <= 1) {
            echo "<a class='fo_re'>처음</a>";
        } else {
            echo "<a href='?page=1'>처음</a>";
        }

        if ($page > 1) {
            $pre = $page - 1;
            echo "<a href='?page=$pre'>이전</a>";
        }

        for ($i = $block_start; $i <= $block_end; $i++) {
            if ($page == $i) {
                echo "<a class='fo_re'>[$i]</a>";
            } else {
                echo "<a href='?page=$i'>[$i]</a>";
            }
        }

        if ($block_num < $total_page) {
            $next = $page + 1;
            echo "<a href='?page=$next'>다음</a>";
        }

        if ($page < $total_page) {
            echo "<a href='?page=$total_page'>마지막</a>";
        }
        ?>
    </div>

    <form class="write_btn" action="review_write.php" method="post">
        <button class="btn btn-outline-dark" type="submit">
            <i class="login"></i>
            write
        </button>
    </form>
</div>
</body>
</html>

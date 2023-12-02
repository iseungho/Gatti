<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gatti</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />
  </head>
  <body>
    <!-- Navigation-->
    <?php include('nav.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-6 fw-bolder">약속 전체보기</h1>
        </div>
        <!-- Search form-->
        <form class="mt-4" action="search_result.php" method="get">
          <div class="input-group">
            <select class="btn btn-outline-light" name="catgo">
              <option value="board_title">제목</option>
              <option value="board_name">글쓴이</option>
              <option value="board_content">내용</option>
            </select>
            <input
              type="text"
              class="form-control"
              placeholder="약속할 식당 이름이나 음식을 검색해보세요!"
              aria-label="Search"
              required="required"
              aria-describedby="button-search"
            />
            <button
              class="btn btn-outline-light"
              type="submit"
              id="button-search"
            >
              검색
            </button>
          </div>
        </form>
      </div>
    </header>
    <!-- Section-->
    <section class="login-section">
      <form action="write.php" method="post">
        <table class="table">
          <thead class="thead-dark">
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
          $sql_total = $conn->query("SELECT COUNT(*) as total FROM board");
          $total_rows = $sql_total->fetch_assoc()['total'];
    
          $list = 10; // Number of items to display per page
          $total_page = ceil($total_rows / $list);
    
          // Calculate the start index for the current page
          $start_num = ($page - 1) * $list;
    
          // Fetch data for the current page
          $sql_page = $conn->query("SELECT * FROM board ORDER BY board_idx DESC LIMIT $start_num, $list");
    
          if (!$sql_page) {
              die("Error in SQL query: " . $conn->error);
          }
    
          while ($board = $sql_page->fetch_array()) {
              $title = $board["board_title"];
              if (strlen($title) > 30) {
                  $title = str_replace($board["board_title"], mb_substr($board["board_title"], 0, 30, "utf-8") . "...", $board["board_title"]);
              }
              ?>
              <tbody>
                <tr>
                  <td><a href="read.php?board_idx=<?php echo $board["board_idx"];?>"><?php echo $title; ?></a></td>
                  <td><?php echo $board['board_name']; ?></td>
                  <td><?php echo date("Y-m-d", strtotime($board['board_date'])); ?></td>
                  <td><?php echo $board['board_hit']; ?></td>
                  <!-- 추천수 표시해주기 위해 추가한 부분 -->
                  <td><?php echo $board['board_thumbup']; ?></td>
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
        <div class="d-flex justify-content-between align-items-center mt-4">
          <a href='?page=1' class='btn' id='firstPageBtn'>
              <span aria-hidden="true"></span> 처음
          </a>
          
          <?php if ($page > 1): ?>
              <a href='?page=<?php echo $page - 1; ?>' class='btn' id='prevPageBtn'>
                  <span aria-hidden="true">&laquo;</span>
              </a>
          <?php else: ?>
              <a class="btn">
                  <span aria-hidden="true">&laquo;</span>
              </a>
          <?php endif; ?>
          
          <div class="pagination">
              <?php for ($i = $block_start; $i <= $block_end; $i++): ?>
                  <?php if ($page == $i): ?>
                      <a class='btn btn-secondary active'><?php echo $i; ?></a>
                  <?php else: ?>
                      <a href='?page=<?php echo $i; ?>' class='btn'><?php echo $i; ?></a>
                  <?php endif; ?>
              <?php endfor; ?>
          </div>
      
          <?php if ($page < $total_page): ?>
              <a href='?page=<?php echo $page + 1; ?>' class='btn' id='nextPageBtn'>
                  <span aria-hidden="true">&raquo;</span>
              </a>
          <?php else: ?>
              <a class='btn' id='nextPageBtn'>
                  <span aria-hidden="true">&raquo;</span>
              </a>
          <?php endif; ?>
          
          <a href='?page=<?php echo $total_page; ?>' class='btn' id='lastPageBtn'>
              마지막 <span aria-hidden="true"></span>
          </a>
      
          <button class="btn btn-secondary" type="submit">
              <i class="login"></i>
              글쓰기
          </button>
        </div>
      </form>
    </section>
    <!-- Footer-->
    <?php include('footer.php'); ?>
  </body>
</html>

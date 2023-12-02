<?php 
    include('UserDB.php');
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div id="board_area"> 
<!-- 18.10.11 검색 추가 -->
<?php
 
  /* 검색 변수 */
  $catagory = $_GET['catgo'];
  $search_con = $_GET['search'];
?>
    <?php if($catagory=='board_title'){
        $catname = '제목';
    } else if($catagory=='board_name'){
        $catname = '작성자';
    } else if($catagory=='board_content'){
        $catname = '내용';
    } ?>
  <h1><?php echo $catname; ?>:<?php echo $search_con; ?> 검색결과</h1>
  <h4 style="margin-top:30px;"><a href="index.php">Gatti</a></h4>
    <table class="list-table">
      <thead>
          <tr>
                <th width="70">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
          $sql2 = $conn->query("SELECT * from board where $catagory like '%$search_con%' order by board_idx desc");
          while($board = $sql2->fetch_array()){
           
          $title=$board["board_title"]; 
            if(strlen($title)>30)
              { 
                $title=str_replace($board["board_title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["board_title"]);
              }
            $sql3 = $conn->query("SELECT * from reply where reply_con_num='".$board['board_idx']."'");
            $rep_count = mysqli_num_rows($sql3);
        ?>
      <tbody>
        <tr>
          <td width="500">
            <?php 
              if($board['board_lock_post']=="1")
              {
              }else{?>

        <!--- 추가부분 18.08.01 --->
        <?php
          $boardtime = $board['board_date']; //$boardtime변수에 board['date']값을 넣음
          $timenow = date("Y-m-d"); //$timenow변수에 현재 시간 Y-M-D를 넣음
          
          if($boardtime==$timenow){
            $img = "";
          }else{
            $img ="";
          }
          ?>
        <!--- 추가부분 18.08.01 END -->
        <a href='read.php?board_idx=<?php echo $board["board_idx"]; ?>'><span style="background:yellow;"><?php echo $title; }?></span><span class="re_ct">[<?php echo $rep_count;?>]<?php echo $img; ?> </span></a></td>
          <td width="100"><?php echo $board['board_name']?></td>
          <td width="100"><?php echo $board['board_date']?></td>
          <td width="100"><?php echo $board['board_hit']; ?></td>

        </tr>
      </tbody>

      <?php } ?>
    </table>
    <!-- 18.10.11 검색 추가 -->
    <div id="search_box2">
      <form action="search_result.php" method="get">
      <select name="catgo">
        <option value="board_title">제목</option>
        <option value="board_name">글쓴이</option>
        <option value="board_content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required"/> <button>검색</button>
    </form>
  </div>
</div>
</body>
</html>
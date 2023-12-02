<!--
* @author   : 전민서
* @fileName : db.php
* @date     : 2023.11.03. 오후 4:28
* @desc    : 데이터베이스
-->

<?php
    // utf-8인코딩
   header('Content-Type: text/html; charset=utf-8'); 

   // localhost = DB주소, web=DB계정아이디, 1234=DB계정비밀번호, post_board="DB이름"
   // $db = new mysqli("localhost","web","1234","post_board");
    $db = new mysqli("127.0.0.1","root","","test");
   $db->set_charset("utf8");

    // 모든 php파일에서 mq 함수로 데이터베이스에 접속
   function mq($sql)
   {
      global $db;
      return $db->query($sql);
   }
?>
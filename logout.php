<?php
    session_start();

    echo '<script>';
    echo 'alert("안녕히 가세요! 안전하게 로그아웃 되었습니다.");';
    echo 'window.location.href = "index.php?success=성공적으로 변경됨";';
    echo '</script>';
    
    session_unset();
    session_destroy();
  
    exit();
?>
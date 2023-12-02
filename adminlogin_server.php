<?php

include('UserDB.php');

if(isset($_POST['admin_id']) && isset($_POST['pass1']))

{   
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id'] );
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1'] );


    if(empty($admin_id))
    {
        header("location: adminlogin_view.php?error=아이디가 비어있어요");
        exit();
    }
    else if(empty($pass1))
    {
        header("location: adminlogin_view.php?error=비밀번호가 비어있어요");
        exit();
    }

    else
    {  
        $sql = "select * from adminn where admin_id = '$admin_id'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1)
        {
            $row = mysqli_fetch_assoc($result);
            $hash = $row['admin_password']; // db에서 저장된 암호 불러옴(암호 저장벨류가 수시로 바뀜 보안 ㄸㅐ문에)

            if(password_verify($pass1, $hash))//(디비에서 불러온 암호와 사용자가 입력한 암호 비교해서 매칭해줌)
            {
                header("location: mypage/adminpage.php");
                exit();
            }
            else
            {
                header("location: adminlogin_view.php?error=비밀번호가 일치하지 않아요");
                exit();
            }
        }
        else
        {
            header("location: adminlogin_view.php?error=회원정보가 없습니다");
            exit();
        }
    }

}
else
{
     header("location: adminlogin_view.php?error=알수없는오류발생");
     exit();
}



?>  


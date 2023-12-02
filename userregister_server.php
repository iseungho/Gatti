<?php

include('UserDB.php');

/*------------------------------------------------------------------------------------------------------------------------
    ------------------------------------------------------------------------------------------------------------------------*/
// 함수는 소괄호(), 실행은 중괄호{}, 변수는 대괄호[] 입니다.
//보안 강화용 코드
if(isset($_POST['user_id']) && isset($_POST['user_name']) && isset($_POST['pass1']) && isset($_POST['pass2']))
//위 변수들이 존재하면 아래 코드들 실행, 사용자가 홈피에서 변수 입력(회원가입 창)

{   
    //POST로 보안 강화해주고 mysqli_real_escape_string로 한층 더욱 보안 강화
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id'] );
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name'] );
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1'] );
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2'] );
    //$ <--그냥 변수, $_ <--전역변수입니다 (슈퍼)


   
    /*------------------------------------------------------------------------------------------------------------------------
    ------------------------------------------------------------------------------------------------------------------------*/
    //에러 체크코드
    if(empty($user_id))
    {
        header("location: userregister_view.php?error=아이디가 비어있어요");
        exit();
    }
    else if(empty($user_name))
    {
        header("location: userregister_view.php?error=닉네임이 비어있어요");
        exit();
    }
    else if(empty($pass1))
    {
        header("location: userregister_view.php?error=비밀번호가 비어있어요");
        exit();
    }
    else if(empty($pass2))
    {
        header("location: userregister_view.php?error=비밀번호가 비어있어요");
        exit();
    }
    else if($pass1 !== $pass2)
    {
        header("location: userregister_view.php?error=비밀번호가 일치하지 않아요");
        exit();

    }
     
    /*------------------------------------------------------------------------------------------------------------------------
    ------------------------------------------------------------------------------------------------------------------------*/
    //여기서부터 값 저장코드 / 암호화 --> 중복체크 --> 저장 순으로 진행
    else
    {  
        //암호화
        //user_password 255자로 한 이유는 암호화를 걸면 시간이 지남에 따라 식별자가 주기적으로 바뀌는데 길이가 얼마나 될 지 모르기에 길게 설정함
        $pass1 = password_hash($pass1, PASSWORD_DEFAULT); //단방향 암호

        //중복체크 , 아이디 또는 닉네임, 아이디와 동시에 닉네임 중복쳋크
        $sql_same = "SELECT * FROM user where user_id = '$user_id' or user_name = '$user_name'";
        $order =  mysqli_query($conn,$sql_same);

        if(mysqli_num_rows($order) > 0)
        {
            header("location: userregister_view.php?error=아이디 또는 닉네임이 이미 있어요");
            exit();
        }
        else
        {   //여기가 저장 하는 부분
            $sql_save = "insert into user(user_id, user_name, user_password) values('$user_id','$user_name','$pass1')";
            $result = mysqli_query($conn, $sql_save);

            //여기부터도 성공 or 에러 메시지 
            if ($result) {
                echo '<script>alert("환영합니다! 성공적으로 가입되었습니다."); window.location.href = "index.php?success=성공적으로 가입됨";</script>';
                exit();
            } else {
                header("location: userregister_view.php?error=가입에 실패하였습니다");
                exit();
            }


        }
    

    }

}
else
{

    header("location: userregister_view.php");
    exit();
}



?>  


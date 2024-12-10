<?php
    session_start();

    include("connection.php");
    include("function.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name =  $_POST['user_name'];
        $password =  $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //save to database
            $user_id = random_num(20);
            $query = "insert into users (user_id ,user_name ,password) values('$user_id' ,'$user_name' ,'$password')";
            
            mysqli_query( $con,$query);

            header("Location: login.php");
            die;
        }else
        {
            echo "Please enter valid info";
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>SignUp</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div id="box">
        <form method="post">
            <h3>SignUp</h3>
            <!-- 登入區塊 -->
            <input type="text" name="user_name"><br><br>
            <input type="text" name="password"><br><br>

            <input type="submit" value="SignUp"><br><br>

            <!-- 註冊帳號 -->
            <a href="login.php">Login</a>


        </form>
    </div>
</body>
</html>
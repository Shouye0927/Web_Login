<?php
    session_start();

    include("connection.php");
    include("function.php");

    $login_error = "";
    $signup_error = "";
    $form_state = "login";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST['form_id'] == "Login"){
            //something was posted
            $user_name =  $_POST['user_name'];
            $password =  $_POST['password'];

            if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
            {
                //read from database
                $query = "select * from users where user_name = '$user_name'";
                
                $result = mysqli_query( $con,$query);

                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password){
                        $_SESSION['user_id'] = $user_data['user_id']; //to let the function "login_check" know it isset = true 
                        header('Location: index.php');
                        die;
                    }else{$login_error = "wrong_password";}

                }else{$login_error = "wrong_username";}

            }else
            {
               $login_error = "wrong_username";
            }
        }

        if($_POST['form_id'] == "SignUp"){
            //something was posted
            $user_name =  $_POST['user_name'];
            $password =  $_POST['password'];

            if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
            {
            //save to database
            $user_id = random_num(20);
            $query = "insert into users (user_id ,user_name ,password) values('$user_id' ,'$user_name' ,'$password')";
            
            mysqli_query( $con,$query);
            $form_state = "login";

            }else{

                $signup_error = "wrong_username";
                $form_state = "signup";
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="script.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="form-box">
            <!-- 登入表單 -->

            <form method="post" class="login-container" id="login">
                <div class="top">
                    <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                    <header>Login</header>
                </div>

                <!-- 登入-表單正常 -->
                <?php if(!$login_error): ?>

                    <div class="input-box">
                        <input type="text" name="user_name" class="input-field" placeholder="Username">
                        <i class="bx bx-user"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" class="input-field" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                
                <!-- 登入-帳號錯誤 -->
                <?php elseif($login_error  == "wrong_username"): ?>

                    <div class="input-box">
                        <input type="text" name="user_name" class="input-field error" placeholder="Username">
                        <i class="bx bx-user"></i>
                        <span>wrong username</span>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" class="input-field" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                
                <!-- 登入-密碼錯誤 -->
                <?php elseif($login_error == "wrong_password"): ?>

                    <div class="input-box">
                        <input type="text" name="user_name" class="input-field" placeholder="Username">
                        <i class="bx bx-user"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" class="input-field error" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                        <span>wrong password</span>
                    </div>
                <?php endif; ?>

                <div class="input-box">
                    <input type="submit" class="submit" name="form_id" value="Login">
                </div>
            </form>

                                <!-- 註冊表單 -->

            <form method="post" class="register-container" id="register">
                <div class="top">
                    <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                    <header>Sign Up</header>
                </div>
                
                <!-- 註冊-帳號名字確認 -->
                <?php if(!$signup_error): ?>
                    <div class="input-box">
                        <input type="text" name="user_name" class="input-field" placeholder="Username">
                        <i class="bx bx-user"></i>
                    </div>
                <?php else: ?>
                    <div class="input-box">
                        <input type="text" name="user_name" class="input-field error" placeholder="Username">
                        <i class="bx bx-user"></i>
                        <span>Username cannot contain numbers.</span>
                    </div>
                <?php endif; ?>

                <div class="input-box">
                    <input type="password" name="password" class="input-field" placeholder="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>

                <input type="hidden" id="form_state" value= "<?php echo $form_state; ?>">

                <div class="input-box">
                    <input type="submit" class="submit" name="form_id" value="SignUp">
                </div>

            </form>

        </div>
    </div>

</body>
</html>


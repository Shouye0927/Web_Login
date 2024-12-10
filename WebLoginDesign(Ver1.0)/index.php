<?php
session_start();
    include("connection.php");
    include("function.php");

    $user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>My website</title>
    </head>

    <h1>this is a h1</h1>
    Hello ,<?php echo $user_data['user_name']; ?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="theme-color" content="#0e0f1a" >
    <title>CLOUD ARM</title>

    <link rel="manifest" href="pwa/manifest.json">
    <link rel="apple-touch-icon" href="pwa/new_icon/192.png">

    <link rel="icon" href="../AUTO_LOGO.png">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
* {
    margin: 0;
    padding: 0;
    font-family: 'poppins', sans-serif;
}

.f-n {
    width: 100%;
    display: flex;
    background-color: #0e0f1a;
    height: 100vh;
    z-index: 100;
    align-items: center;
    justify-content: center;
}

.f-n input {
    font-style: 25px;
    border: none ;
    outline: none;
    background-color: transparent;
    color: #fff;
    height: 40px;
    width: 50%;
}

.f-n hr{
    margin: 0px 22% 0 22%;
    border: 0.5px solid #910505;
}

.f-n .login-btn{
    border-radius: 30px;
    width: 40%;
    background: linear-gradient(27deg, rgba(190, 0, 0,0.8) , rgba(50,0,0,0.6));
   /* color:#FF3636; */
   color: #ABABAB;
    margin-top: 50px;
    font-size: 17px;
    height: 40px;
}

.f-n img{
    margin-top: -100px;
}



</style>

<body>
<?php 
session_start();
include("../connect.php");
$connection =mysqli_connect($db_host,$db_user, $db_pass, $db_database);
// check for form submission
if (isset($_POST['check'])) {

    $errors = array();

    // check if the username and password has been entered
    if (!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1 ) {
        $errors[] = 'Username is Missing / Invalid';
    }

    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
        $errors[] = 'Password is Missing / Invalid';
    }

    // check if there are any errors in the form
    if (empty($errors)) {
        // save username and password into variables
        $email 		= mysqli_real_escape_string($connection, $_POST['username']);
        $password 	= mysqli_real_escape_string($connection, $_POST['password']);
        $hashed_password = sha1($password);

        // prepare database query
        $query = "SELECT * FROM user 
                    WHERE username = '{$email}' 
                    AND password = '{$password}' 
                    LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            // query succesfful

            if (mysqli_num_rows($result_set) == 1) {
                // valid user found
                
                // redirect to users.php
                session_regenerate_id();
                $row=mysqli_fetch_assoc($result);
				$_SESSION['SESS_MEMBER_ID'] = $row['id'];
				$_SESSION['SESS_FIRST_NAME'] = $row['name'];
				$_SESSION['SESS_LAST_NAME'] = $row['position'];
				$_SESSION['USER_LEWAL'] = $row['user_lewal'];


                header('Location: index.php');
            } else {
                // user name and password invalid
                $errors[] = 'Invalid Username / Password';
            }
        } else {
            $errors[] = 'Database query failed';
        }
    }
}
?>

    <div class="f-n">
        <div style="text-align: center;">
            <img src="../AUTO_LOGO.png" width="30%" alt="">

            <p style="margin: 5px 0px 150px 0px; font-size:12px">AUTO DIMENSION</p>
            <p style="color:#910505"><?php 
					if (isset($errors) && !empty($errors)) {
						echo '<p class="error">Invalid Username / Password</p>';
					}
				?></p>
            <br>
            <form action="" method="post">
                
                <input type="text" style="font-size: 20px;" name="username" placeholder="user name" >
                <i class="ion-person"></i>
                <hr><br>

                
                <input type="password" style="font-size: 20px;" name="password" placeholder="password" >
                <i class="ion-key"></i><hr><br>
                <input type="hidden" name="check">
                <input type="submit" value="Login" class="login-btn">
            </form>

        </div>
    </div>


</body>

</html>
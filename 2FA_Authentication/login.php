<?php
session_start();

require_once("./phpmailer/mail_function.php");  //email
include_once('./includes_folder/db.php');       //database conn

$error_message = [];

if(!empty($_POST["submit_email"])) {

    //defined parameters
    $email              = filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
    $password           = $_POST['password_hash'];
    $not_expired        = 'no';
    $current_time       = date("Y-m-d H:i:s");

    $query              = "SELECT * FROM users WHERE email = '$email'";  //query database table
    $result             = mysqli_query($conn, $query);  
           
    if(mysqli_num_rows($result) > 0)  //loops database table and check if user email exist
    {  
        while($row = mysqli_fetch_array($result))  
        {  
            if($row['otp'] == 'yes')     //loop through the database table and checks if yes exist, and execute 
            {
                if(password_verify($password, $row["password_hash"]))  // encrypt password algorithm
                {    
                    $otp         = rand(100000,999999);                 // generate OTP
                    $mail_status = sndmail($email, $otp);               // Send OTP
                    $result      = mysqli_query($conn,"INSERT INTO otp_expiry (email,otp,is_expired,create_at) VALUES ('$email','$otp','$not_expired','$current_time')");        //insert OTP in OTP expiry table
                    $current_id  = mysqli_insert_id($conn);
        
                    if(!empty($current_id))
                    {
                        header('location: otp.php');
                    }  
                }  
                else{
                    $error_message['password_hash']  = "<div class=\"text-danger\">Password not match! </div>"; 
                }  
            }
            else{   //redirect if OTP is not activated
                if(password_verify($password, $row["password_hash"]))  // encrypt password algorithm
                {    
                    $_SESSION["email"] = $email;
                    header('location: dahboard-main.php');
                }else{
                    $error_message['password_hash']  = "<div class=\"text-danger\">Password not match! </div>"; 
                } 
            } 
        }  
    }  
    else{  
        $error_message['email']  = "<div class=\"text-danger\">Email not match! </div>"; 
    }  
                                                                   
}


?>

<!DOCTYPE html>
<html style="background: rgba(255,255,255,0);">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dropsprint</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="text-center" style="/*background: rgb(228,228,228);*/">
    <nav class="navbar navbar-dark navbar-expand-md fixed-top bg-dark float-right" style="border-color: rgb(0,0,0);border-right-color: rgba(0,0,0,0);height: 80px;">
        <div class="container-fluid"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse text-center" id="navcol-1"><img class="img-fluid ml-auto" src="assets/img/dp.svg">
                <ul class="nav navbar-nav d-xl-flex justify-content-between ml-auto align-items-xl-center">
                    <li class="nav-item" style="color: rgb(255,255,255);"></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="login-header" style="/*background: rgba(255,255,255,0.88);*/">Login to Internal Portal.</h1>
            </div>
            
        </div>
    </div>
    <div class="login-clean">
        <form method="post">
            <div class="illustration"><i class="fa fa-user-circle"></i></div>
            <?php  if(count($error_message) > 0): 
                foreach($error_message as $error):
                    echo $error;            // output error messages
                endforeach;
            endif;
            ?>
            
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password_hash" placeholder="Password"></div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" value="submit" name="submit_email" type="submit">Log In</button>
            </div><a class="forgot" href="#">Forgot your email or password?<br>Contact Admin for Reset!</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
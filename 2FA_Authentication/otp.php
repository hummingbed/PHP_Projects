

<?php

session_start();

include_once('./includes_folder/db.php');

$error_message = [];

if(!empty($_POST["submit_otp"]))
    {
        //check if user otp is already in database
        $result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "' AND is_expired = 'no' AND NOW() <= DATE_ADD(create_at, INTERVAL 5 MINUTE)");
        
        $count  = mysqli_num_rows($result);

        $email  = mysqli_fetch_assoc($result);   //fetch the email from the database to enable session for login

        if(!empty($count)) 
        {       //update db and login user if user otp matches
            $result            = mysqli_query($conn,"UPDATE otp_expiry SET is_expired = 'yes' WHERE otp  = '" . $_POST["otp"] . "'");
            $_SESSION["email"] = $email["email"];
            header('location: dahboard-main.php');	
        }   
        else{
            $error_message['otp'] = "<div class=\"text-danger\">Invalid or Expired OTP! </div>";  //error message if OTP does'nt match
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
            <div class="form-group"><input class="form-control" type="number" name="otp" placeholder="###"></div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" value="submit" name="submit_otp" type="submit">Log In</button>
            </div>            
        </form>   
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
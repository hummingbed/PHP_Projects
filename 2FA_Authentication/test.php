<?php
session_start();
// $conn = mysqli_connect('localhost', 'root', '', 'drops_print');

include_once('./includes_folder/db.php');  

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password_hash'];
    $otp   =$_POST['otp'];
    //$password           = md5($password);
    $password = password_hash($password, PASSWORD_BCRYPT);

     
    $insertSql =  $conn->query("INSERT INTO users (email,password_hash,otp) VALUES ('$email','$password','$otp')");
                                            

        if($insertSql)
        {       
            echo   1;
        }else{
            echo 2;
        }
}

// $p1 = 1234;

// $p2 =1234;

// $pass1 = md5($p1);

// $pass2 = md5($p2);

// // echo $pass2 .'<br>';

// // echo $pass1;

// if($pass1 === $pass2){
//     echo 1;
// }else{
//     echo 2;
// }

?>

<form action="" method="post">
    <input type="text" name="email">
    <input type="text" name="password_hash">
    <input type="text" name="otp">
    <input type="submit" name="submit">
</form>
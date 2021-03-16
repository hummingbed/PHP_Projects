<?php	

	function sndmail($email, $otp){
			$to = $email;
            $subject = "Dropsprint OTP";
            $message = "Use this OTP code $otp to confirm your account";
            $headers = "from: sniyokratos@gmail.com";
            mail($to,$subject,$message,$headers);
            // header('location: verify.php');
	}
?>
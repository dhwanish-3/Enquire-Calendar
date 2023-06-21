<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once "phpmailer/Exception.php";
require_once "phpmailer/PHPMailer.php";
require_once "phpmailer/SMTP.php";
require_once "backup/confidential.php";
require_once "backup/config.php";

if(isset($_POST['submit'])){
    $mail=new PHPMailer(true);
    $mail->SMTPDebug=2;
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $emailQuery="SELECT * FROM user_details WHERE email='$email'";
    $query=mysqli_query($conn,$emailQuery);
    if(mysqli_num_rows($query)>0){
        $userdata=mysqli_fetch_array($query);
        $username=$userdata['name'];
        $token=$userdata['token'];
        try{
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username=$emailAddress;
            $mail->Password=$AppSpecificpassword;
            $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port='587';

            $mail->setFrom($emailAddress);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject='Reset Password';
            $mail->Body="<h3>Hi $username,
            Click here to update your password
            $hostUri/update_password.php?token=$token</h3>";
            $mail->send();
            $_SESSION['forgot-msg']="Check mail to update password";
        }catch(Exception $e){
            $_SESSION['forgot-msg']="Failed to send mail...\nCheck the email entered and try again.";
        }
    }else{
        $_SESSION['forgot-msg']="Account not found";
    }
}
header('Location: forgot_password.php');
?>
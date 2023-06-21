<?php
require '../backup/config.php';
if(isset($_POST['submit'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $emailQuery="SELECT * FROM user_details WHERE email='$email'";
    $query=mysqli_query($conn,$emailQuery);
    if(mysqli_num_rows($query)>0){
        $userdata=mysqli_fetch_array($query);
        $username=$userdata['name'];
        $subject="Reset Password";
        $token=$userdata['token'];
        $body="Hi, $username Click here to update your password
        http://localhost/enquirecalendardhwanish/update_password.php?token=$token ";
        $sender_email="From: dhwani333sh@gmail.com";

        if(mail($email, $subject, $body , $sender_email)){
            $_SESSION['forgot-msg']="Check mail to update password";
        }else{
            $_SESSION['forgot-msg']="Failed to send mail...\nCheck the email entered and try again.";
        }
    }else{
        $_SESSION['forgot-msg']="Account not found";
    }
}
header('Location: ../forgot_password.php');
?>
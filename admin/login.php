<?php
session_start();
require '../backup/confidential.php';
if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
    if($email==$adminEmail && $password==$adminPassword){
        $_SESSION['email']=$adminEmail;
        $_SESSION['name']=$adminName;
        header("Location: index.php?login=success");
    }else{
        $_SESSION['login-msg']="Please use admin credentials";
        header("Location: index.php?login=failure");
    }
}else{
    echo "Form not submitted";
}
?>
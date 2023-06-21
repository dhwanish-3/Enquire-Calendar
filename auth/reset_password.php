<?php
require '../backup/config.php';
$newPassword=mysqli_real_escape_string($conn,$_POST['password']);
$confirmPassword=mysqli_real_escape_string($conn,$_POST['cpassword']);
if(isset($_SESSION['token'])){
    $token=$_SESSION['token'];
    if(strlen($newPassword)<6){
		$conn->close();
		$_SESSION['update-msg']="Password length must be atleast 6 characters";
		header("Location: ../update_password.php?token=$token");
		exit();
	}
    if($newPassword!=$confirmPassword){
        $_SESSION['update-msg']="Paswords do not match";
        header("Location: ../update_password.php?token=$token");
        exit();
    }
    $tokenQuery="SELECT * FROM user_details WHERE token='$token'";
    $query=mysqli_query($conn,$tokenQuery);
    if(mysqli_num_rows($query)>0){
        $updatePassword=password_hash($newPassword,PASSWORD_BCRYPT);
        $updateQuery="UPDATE user_details SET password='$updatePassword' WHERE token='$token'";
        $query=mysqli_query($conn,$updateQuery);
        if($query){
            $_SESSION['login-msg']="Your password has been updated";
            header('Location: ../index.php?login=password_updated');
            exit();
        }else{
            $_SESSION['update-msg']="Could not update password.\nPlease try again.";
        }
    }else{
        $_SESSION['update-msg']="Account not found";
    }
    header("Location: ../update_password.php?token=$token");
    exit();
}else{
    $_SESSION['update-msg']="Could not get token for verification\nPlease try again.";
    header("Location: ../update_password.php");
}
?>
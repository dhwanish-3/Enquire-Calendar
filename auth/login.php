<?php
    require '../backup/config.php';
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);
    $check = $conn->query("SELECT * FROM user_details WHERE email = '{$email}'");
    if($check->num_rows>0){
        $row = mysqli_fetch_assoc($check);
        $pass_decode=password_verify($password,$row['password']);
        if($pass_decode){
            if(isset($_POST['remember'])){
                setcookie('email',$email,time()+86400);
                setcookie('password',$password,time()+86400);
            }
            $_SESSION['name']=$row['name'];
            $_SESSION['email']=$email;
            $_SESSION['category']=$row['category'];
            $_SESSION['general']=$row['general'];
            $_SESSION['scitech']=$row['scitech'];
            $_SESSION['business']=$row['business'];
            $_SESSION['scitechbiz']=$row['scitechbiz'];
            $_SESSION['sports']=$row['sports'];
            $_SESSION['mela']=$row['mela'];
            $conn->close();
            header("Location: ../index.php?login=success");
        }
        else{
            $conn->close();
            $_SESSION['login-msg']="Password is incorrect";
            header("Location: ../index.php?login=password_is_incorrect");
        }
    }
    else{
        $conn->close();
        $_SESSION['login-msg']="Account not found";
        header("Location: ../index.php?login=no_account_found");
    }
?>

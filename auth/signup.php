<?php
    require '../backup/config.php';
	$name = mysqli_real_escape_string($conn,$_POST['name']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$pass = mysqli_real_escape_string($conn,$_POST['password']);
	$confirmPassword = mysqli_real_escape_string($conn,$_POST['cpassword']);
	if(strlen($pass)<6){
		$conn->close();
		$_SESSION['signup-msg']="Password length must be atleast 6 characters";
		header("Location: ../index.php?signup=password_length_not_enough");
		exit();
	}
	if($pass!=$confirmPassword){
		$conn->close();
		$_SESSION['signup-msg']="Passwords didn't match";
		header("Location: ../index.php?signup=passwords_dont_match");
		exit();
	}
	$password = password_hash($pass,PASSWORD_BCRYPT);
	$token = bin2hex(random_bytes(15));
	// checking email already in use
	$check = $conn->query("SELECT * FROM user_details WHERE email = '{$email}'");
	if($check->num_rows>0){
		$conn->close();
		$_SESSION['signup-msg']="Email already in use";
		header("Location: ../index.php?signup=email_already_in_use");
		exit();
	}
	else{
		$stmt = $conn->prepare("INSERT INTO user_details(name,email,password,token) VALUES(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $name,$email,$password,$token);
		$execval = $stmt->execute();
		$_SESSION['email'] = $email;
		$_SESSION['name'] = $name;
		$_SESSION['password'] = $password;
		$_SESSION['token'] = $token;
		$stmt->close();
		$conn->close();
		header("Location: ../index.php?signup=success");
	}
?>

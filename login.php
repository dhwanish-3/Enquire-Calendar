<?php
    session_start();
	$email = $_POST['email'];
	$password = $_POST['password'];
	// Database connection
	// $conn = new mysqli('sql202.epizy.com','epiz_34082873','EUBHcmaeso','epiz_34082873_enquirethecalender');
	$conn = new mysqli('localhost','root','','test');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		// checking email already in use
		$check = $conn->query("SELECT * FROM user_details WHERE email = '{$email}'");
		if($check->num_rows>0){
            $row = mysqli_fetch_assoc($check);
            if($row['password']==$password){
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
                header("Location: index.php?login=success");
            }
            else{
                $conn->close();
                header("Location: index.php?login=password_is_incorrect");
            }
		}
		else{
			$conn->close();
			header("Location: index.php?login=no_account_found");
		}
	}
?>

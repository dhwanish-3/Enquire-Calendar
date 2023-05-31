<?php
require 'config.php';
// if(isset($_SESSION['email'])){
//     header('Location: index.php?google-login=success');
//     exit;
// }
require 'google-api/vendor/autoload.php';
// Creating new google client instance
$client = new Google_Client();
// Enter your Client ID
$client->setClientId('822601038916-8ugu41rkdegqvt8q1as5r6silnrniu2g.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/enquirecalender/google.php');
// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");
if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if(!isset($token["error"])){
        $client->setAccessToken($token['access_token']);
        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        // Storing data into database
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        // checking user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT `email` FROM `user_details` WHERE `email`='$email'");
        if(mysqli_num_rows($get_user) > 0){
            $row=mysqli_fetch_assoc($get_user);
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name']; 
            $_SESSION['general'] = $row['general']; 
            $_SESSION['scitech'] = $row['scitech']; 
            $_SESSION['business'] = $row['business']; 
            $_SESSION['scitechbiz'] = $row['scitechbiz']; 
            $_SESSION['sports'] = $row['sports']; 
            $_SESSION['mela'] = $row['mela']; 
            header('Location: index.php?login=success');
            exit;
        }
        else{
            // if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `user_details`(`name`,`email`) VALUES('$full_name','$email')");
            if($insert){
                $_SESSION['email'] = $email; 
                $_SESSION['name'] = $full_name; 
                header('Location: index.php?signup=success');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }
        }
    }
}
?>
<?php
require_once 'config.php';
require 'google-api/vendor/autoload.php';
require_once "confidential.php";
// Creating new google client instance
$client = new Google_Client();
// Enter your Client ID
$client->setClientId($clientId);
// Enter your Client Secrect
$client->setClientSecret($ClientSecret);
// Enter the Redirect URL
$client->setRedirectUri($redirectUri);
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
        $full_name = mysqli_real_escape_string($conn, trim($google_account_info->name));
        $email = mysqli_real_escape_string($conn, $google_account_info->email);
        // checking user already exists or not
        $get_user = mysqli_query($conn, "SELECT * FROM user_details WHERE email='$email'");
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
            $_SESSION['category'] = $row['category'];
            header('Location: index.php?google-login=success');
        }
        else{
            // if user not exists we will insert the user
            $token = bin2hex(random_bytes(15));
            $insert = mysqli_query($conn, "INSERT INTO user_details(name,email,token) VALUES('$full_name','$email','$token')");
            if($insert){
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $full_name; 
                header('Location: index.php?google-signup=success');
            }
            else{
                header('Location: index.php?google-signup=failure');
            }
        }
    }
}
?>
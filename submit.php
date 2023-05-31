<?php
    session_start();
    require 'config.php';
    $interestedEvents=array();
    if(isset($_POST["go"])){
        if(isset($_SESSION["email"])){
            $email=$_SESSION["email"];
            $general=intval($_SESSION["general"]);
            $scitech=intval($_SESSION["scitech"]);
            $business=intval($_SESSION["business"]);
            $scitechbiz=intval($_SESSION["scitechbiz"]);
            $sports=intval($_SESSION["sports"]);
            $mela=intval($_SESSION["mela"]);
            $category=$_SESSION["category"];
            $submit=$conn->query("UPDATE user_details SET general = '{$general}', scitech='{$scitech}', business='{$business}, scitechbiz='{$scitechbiz}', sports='{$sports}', mela='{$mela}' WHERE email='{$email}'");
            $conn->close();
        }
    }
?>
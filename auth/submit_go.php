<?php
require '../backup/config.php';
if(isset($_SESSION["email"])){
    $email=$_SESSION["email"];
    $general=intval($_POST["general"]);
    $_SESSION["general"]=intval($_POST["general"]);
    $scitech=intval($_POST["scitech"]);
    $_SESSION["scitech"]=intval($_POST["scitech"]);
    $business=intval($_POST["business"]);
    $_SESSION["business"]=intval($_POST["business"]);
    $scitechbiz=intval($_POST["scitechbiz"]);
    $_SESSION["scitechbiz"]=intval($_POST["scitechbiz"]);
    $sports=intval($_POST["sports"]);
    $_SESSION["sports"]=intval($_POST["sports"]);
    $mela=intval($_POST["mela"]);
    $_SESSION["mela"]=intval($_POST["mela"]);
    $open = $_POST['open'] ?? 0;
    $school = $_POST['school'] ?? 0;
    $college = $_POST['college'] ?? 0;
    $category = "open";
    if($open && $school && $college) $category = "open";
    else if($open && $school) $category = "open-school";
    else if($open && $college) $category = "open-college";
    else if($school && $college) $category = "school-college";
    else if($school) $category = "school";
    else if($college) $category = "college";
    $_SESSION['category']=$category;
    $submit=$conn->query("UPDATE user_details SET general = '{$general}', scitech='{$scitech}', business='{$business}', scitechbiz='{$scitechbiz}', sports='{$sports}', mela='{$mela}', category='{$category}' WHERE email='{$email}'");
    $conn->close();    
}
// header("Location: ../index.php");
?>
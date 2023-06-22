<?php
require_once "../backup/config.php";

if($_POST['approve-ad']){
    // getting the data
    $name = $_POST["name"];
    $imageUrl = $_POST["imageUrl"];
    $date = $_POST["date"];
    $venue = $_POST["venue"];
    $type = $_POST["type"];
    $quiz_masters = $_POST["quiz_masters"];
    $contact = $_POST["contact"];
    $link = $_POST["link"];
    $rules = $_POST["rules"];
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

    // inserting this to ads table
    $adQuery="INSERT INTO ads (date,name,venue,imageUrl,category,type,quiz_masters,contact,link,ruleS) VALUES('$date', '$name', '$venue','$filePath','$category','$type','$quiz_masters','$contact','$link','$rules')";
    $adResult=mysqli_query($conn,$adQuery);
    if($adResult){
        echo "success added";
    }else{
        echo "failed to insert";
    }
}
?>
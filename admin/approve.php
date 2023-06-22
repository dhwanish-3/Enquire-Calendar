<?php
require_once "../backup/config.php";
if($_POST['approve']){
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

    // inserting this evemt to events table
    $eventQuery="INSERT INTO events (date,name,venue,imageUrl,category,type,quiz_masters,contact,link,ruleS) VALUES('$date', '$name', '$venue','$filePath','$category','$type','$quiz_masters','$contact','$link','$rules')";
    $eventResult=mysqli_query($conn,$eventQuery);
    if($eventResult){
        $id=mysqli_insert_id($conn);
        echo "inserted to events '$id'";
        // getting the date details from quiz_calendar
        $dateQuery="SELECT * FROM quiz_calender WHERE date='$date'";
        $dateResult=mysqli_query($conn,$dateQuery);
        if($dateResult->num_rows>0){
            // if there are events on this date
            $calendar=mysqli_fetch_assoc($dateResult);
            $no_of_events=$calendar['no_of_events'];
            $events=json_decode($calendar['events']);
            $type_of_events=json_decode($calendar['type']); // name of column
            $no_of_events++;
            array_push($events,$id); // have to get id
            $jsonEvents=json_encode($events);
            if(!in_array($category,$type_of_events)){
                array_push($type_of_events,$category);
            }
            $jsonTypes=json_encode($type_of_events);
            // updating the calendar
            $updateQuery="UPDATE quiz_calender SET no_of_events='$no_of_events', events='$jsonEvents',type_of_events='$jsonEvents' WHERE date='$date'";
            $updateResult=mysqli_query($conn,$updateQuery);
            if($updateResult){
                echo "updated the calender also";
            }else{
                echo "failed to update calendar";
            }
        }
    }else{
        echo "failed to insert into results";
    }
}
?>
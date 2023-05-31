<?php
    session_start();
    require 'config.php';
    $interestedEvents=array();
    if(isset($_POST["go"])){
        if(isset($_SESSION["general"])){
            $general=intval($_SESSION["general"]);
            $scitech=intval($_SESSION["scitech"]);
            $business=intval($_SESSION["business"]);
            $scitechbiz=intval($_SESSION["scitechbiz"]);
            $sports=intval($_SESSION["sports"]);
            $mela=intval($_SESSION["mela"]);
            $category=$_SESSION["category"];
        }
        else if(isset($_SESSION["email"])){
            $result=$conn->query("SELECT * FROM user_details email = '{$_SESSION["email"]}'");
            if($result->num_rows>0){
                $row = mysqli_fetch_assoc($result);
                $general=intval($row["general"]);
                $scitech=intval($row["scitech"]);
                $business=intval($row["business"]);
                $scitechbiz=intval($row["scitechbiz"]);
                $sports=intval($row["sports"]);
                $mela=intval($row["mela"]);
                $category=$row["category"];
            }
            else{
                $conn->close();
                header('Location : index.php?something_went_wrong');
                exit();
            }
        }
        $interest=array($general,$scitech,$business,$scitechbiz,$sports,$mela);
        sort($interest);
        $j=0;
        for($i=0;$i<10;$i++){
            $events=$conn->query("SELECT * FROM events WHERE category = '{$category}' AND type = '{$interest[$j]}'");
            if($events->num_rows>0){
                while($eventRow=mysqli_fetch_assoc($events) && $i<10){
                    array_push($interestedEvents,$eventRow);
                    $i++;
                }   
            }
            $j++;
        }
        echo json_encode($interestedEvents);
    }
?>
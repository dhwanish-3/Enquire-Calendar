<?php
require_once "../backup/config.php";
$listofRequests=array();
$query="SELECT * FROM request_events";
$result=$conn->query($query);
if($result->num_rows>0){
    $row=mysqli_fetch_assoc($result);
    while($row){
        array_push($listofRequests,$row);
        $row=mysqli_fetch_assoc($result);
    }
}
echo json_encode($listofRequests);
?>
<?php
require_once "../backup/config.php";
$listofAds=array();
$query="SELECT * FROM ads";
$result=$conn->query($query);
if($result->num_rows>0){
    $row=mysqli_fetch_assoc($result);
    while($row){
        array_push($listofAds,$row);
        $row=mysqli_fetch_assoc($result);
    }
}
echo json_encode($listofAds);
?>
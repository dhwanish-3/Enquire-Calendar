<?php
require_once "../backup/config.php";
if(isset($_SESSION['delete-ad'])){
    $deleteId=$_SESSION['delete-id'];
    $deleteQuery="DELETE FROM ads WHERE id='$deleteId'";
    $deleteResult=mysqli_query($conn,$deleteQuery);
    if($deleteResult){
        echo "successfully deleted";
    }else{
        echo "Could not delete item";
    }
}
?>
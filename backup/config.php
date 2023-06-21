<?php
require_once "confidential.php";
session_start();
session_regenerate_id(true);
$conn = mysqli_connect($hostName,$mySqlUsername,$mySqlPassword,$databaseName);
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    // exit();
}
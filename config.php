<?php
session_start();
session_regenerate_id(true);
// change the information according to your database
// $db_connection = mysqli_connect('sql202.epizy.com','epiz_34082873','EUBHcmaeso','epiz_34082873_enquirethecalender');
$conn = mysqli_connect("localhost","root","","test");
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}
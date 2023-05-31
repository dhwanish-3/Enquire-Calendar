<?php
  require 'config.php';
  $name = $_POST["name"];
  $date = $_POST["date"];
  $venue = $_POST["venue"];
  $category = $_POST["category"];
  $type = $_POST["type"];
  $quiz_masters = $_POST["quiz_masters"] ?? 0;
  $contact = $_POST["contact"];
  $link = $_POST["link"];
  $apply_ad = $_POST["apply_ad"] ?? 0;
  $number = $_POST["number"]; // applicants phoneNumber
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
    header('Location: index.php?image_does_not_exist');
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];
    // $validImageExtension = ['jpg', 'jpeg', 'png'];
    // $imageExtension = explode('.', $fileName);
    // $imageExtension = strtolower(end($imageExtension));
    // if ( !in_array($imageExtension, $validImageExtension) ){
    //   echo $imageExtension;
    //   echo "<script>
    //     alert('Invalid Image Extension');
    //   </script>";
    //   // header('Location: index.php?invalid_image');
    // }
     if($fileSize > 10000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
      header('Location: index.php?image_too_large');
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'posters/' . $newImageName);
      $query = "INSERT INTO request_event(date,name,venue,imageUrl,category,type,quiz_masters,contact,link,applicants_phone,apply_ad) VALUES('$date', '$name', '$venue','$newImageName','$category','$type','$quiz_masters','$contact','$link','$number','$apply_ad')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Applied');
        // document.location.href = 'data.php';
      </script>
      ";
      header('Location: index.php?successfully_applied');
    }
  }
?>
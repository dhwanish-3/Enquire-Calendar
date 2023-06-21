<?php
  require '../backup/config.php';
  $name = $_POST["name"];
  $date = $_POST["date"];
  $venue = $_POST["venue"];
  $type = $_POST["type"];
  $quiz_masters = $_POST["quiz_masters"];
  $contact = $_POST["contact"];
  $link = $_POST["link"];
  $rules = $_POST["rules"];
  $apply_ad = $_POST["apply_ad"] ?? 0;
  $number = $_POST["number"]; // applicants phoneNumber
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
  // echo "<script> alert('$category'); </script>";
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
    header('Location: ../index.php?image_does_not_exist');
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo $imageExtension;
      echo "<script>
        alert('Invalid Image Extension');
      </script>";
      header('Location: ../index.php?invalid_image');
    }
    if($fileSize > 5000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
      header('Location: ../index.php?image_too_large');
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;
      $filePath = 'posters/'.$newImageName;
      $newPath='../'.$filePath;
      move_uploaded_file($tmpName, $newPath);
      $query = "INSERT INTO request_event(date,name,venue,imageUrl,category,type,quiz_masters,contact,link,rules,applicants_phone,apply_ad) VALUES('$date', '$name', '$venue','$filePath','$category','$type','$quiz_masters','$contact','$link','$rules','$number','$apply_ad')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Applied');
      </script>
      ";
      header('Location: ../index.php?successfully_applied');
    }
  }
?>
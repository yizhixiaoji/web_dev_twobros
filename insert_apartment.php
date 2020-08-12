<html>
<head>
  <title>TwoBrows Entry Results</title>
</head>
<body>
<p><a href="twobros.php">Back to Home</a></p>

<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Upload Sucessfully!";
    
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
  // create short variable names
  $streetAddress=$_POST['streetAddress'];
  $unitNumber=$_POST['unitNumber'];
  $price=$_POST['price'];
  $size=$_POST['size'];
  $pictures=$_POST['pictures'];

  if (!$streetAddress || !$unitNumber || !$price || !$size || !$pictures) {
     echo "You have not entered all the required details.<br />"
          ."Please go back and try again.";
     exit;
  }

  if (!get_magic_quotes_gpc()) {
    $streetAddress = addslashes($streetAddress);
    $unitNumber = doubleval($unitNumber);
    $pictures = addslashes($pictures);
    $price = doubleval($price);
    $size = doubleval($size);
  }

  @ $db = new mysqli('localhost', 'bookorama', '123456789', 'twobros');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
  
  $query = "insert into `apartment` (`apartmentId`, `price`, `pictures`, `size`, `streetAddress`, `unitNumber`) VALUES
  (NULL, '".$price."', '".$pictures."', '".$size."', '".$streetAddress."', '".$unitNumber."')";
  $result = $db->query($query);

  if ($result) {
      echo  $db->affected_rows." apartments inserted into database.";
  } else {
  	  echo "An error has occurred.  The item was not added.";
  }

  $db->close();
?>
</body>
</html>
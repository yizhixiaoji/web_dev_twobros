<html>
<head>
  <title>TwoBrows Entry Results</title>
</head>
<body>
<p><a href="twobros.php">Back to Home</a></p>

<?php
  // create short variable names
  $apartmentId=$_POST['apartmentId'];
  $streetAddress=$_POST['streetAddress'];
  $unitNumber=$_POST['unitNumber'];
  $price=$_POST['price'];
  $size=$_POST['size'];
  $pictures=$_POST['pictures'];

  if (!$apartmentId || !$streetAddress || !$unitNumber || !$price || !$size || !$pictures) {
     echo "You have not entered all the required details.<br />"
          ."Please go back and try again.";
     exit;
  }

  if (!get_magic_quotes_gpc()) {
    $apartmentId = addslashes($apartmentId);
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

  $query = "insert into apartments values
            ('".$apartmentId."', '".$streetAddress."', '".$unitNumber."', '".$price."', '".$size."', '".$pictures."')";
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
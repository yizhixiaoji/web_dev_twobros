<html>
<title>Add New Apartment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
        .mySlides {display: none}
        </style>
<head>
       <title>TwoBros Catalog</title>
</head>
<Body>

<p><a href="twobros.php">Back to Home</a></p>
<h1>TwoBros Catalog</h1>

<?php

  @ $db = new mysqli('localhost', 'bookorama', '123456789', 'twobros');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

 if (isset($_POST['update']) && isset($_POST['newapartmentId'])){

    // If the hidden field 'update' has been set
      $apartmentId=$_POST['newapartmentId'];
      $oldapartmentId=$_POST['apartmentId'];
      $streetAddress=$_POST['newstreetAddress'];
      $unitNumber=$_POST['newunitNumber'];
      $price=$_POST['newprice'];
      $size=$_POST['newsize'];
      $pictures=$_POST['newpictures'];

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

    // The UPDATE SQL statement
    $query = "UPDATE apartments SET apartmentId='$apartmentId', streetAddress='$streetAddress', unitNumber = '$unitNumber', price = '$price' , size = '$size', pictures = '$pictures' WHERE apartmentId = '$oldapartmentId'";
    // echo $query;

    $result = $db->query($query);

    if ($result) {
        echo  $db->affected_rows." apartments info updated in the database.";

    } else {
        echo "An error has occurred.  The item was not updated.";
        exit;
    }
 }

  $query = "select * from apartments";
  $result = $db->query($query);
  
  $num_results = $result->num_rows;

  echo "<p>Number of apartments found: ".$num_results."</p>";



  for ($i=0; $i <$num_results; $i++) {
    $row = $result->fetch_assoc();
    echo "<p style='text-align:left;'><strong> Street Adress: ";
    echo htmlspecialchars(stripslashes($row['streetAddress']));
    echo "</strong><br />";
    echo "<p style='text-align:left;'> Unit Number: ";
    echo stripslashes($row['unitNumber']);
    echo "<br />";
    echo "<p style='text-align:left;'> Price: ";
    echo stripslashes($row['price']);
    echo "<br />";
    echo "<p style='text-align:left;'> Size: ";
    echo stripslashes($row['size']);
    echo "<br />";
    echo "<p style='text-align:left;'> Views: ";
    echo stripslashes($row['pictures']);
    echo "<br />";
    echo "<p style='text-align:left;'> Apartment ID: ";
    echo stripslashes($row['apartmentId']);
    echo "<br />";
    echo "</p>";

     $streetAddress= $row['streetAddress'];
     $unitNumber= $row['unitNumber'];
     $oldapartmentId = $row['apartmentId'];
     $price = $row['price'];
     $size = $row['size'];
     $pictures = $row['pictures'];

    // Add Delete buttons and hidden fields for each query result
    //Make sure there is no space before the leading _
    echo <<<_END
    <form action="update_apartment.php" method="post">
    <input type="text" size="50" name="newstreetAddress" value= '$streetAddress' /><br>
    <input type="text" name="newunitNumber" value= '$unitNumber' /><br>
    <input type="text" name="newapartmentId" value= '$oldapartmentId' ><br>
    <input type="text" name="newprice" value= $price /><br>
    <input type="text" name="newsize" value= $size /><br>
    <input type="text" size="20" name="newpictures" value= $pictures /><br>
    <input type="hidden" name="update" value="yes" />
    <input type="hidden" name="apartmentId" value=$oldapartmentId />
    <input type="submit" value="UPDATE RECORD" /></form>
_END;
     
  }

  $result->free();
  $db->close();
?>

</body>
</html>
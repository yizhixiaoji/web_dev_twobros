<html>
        <title>Delete Apartment</title>
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
  <title>TwoBros - Delete Apartment Record</title>
</head>
<body class="w3-content w3-border-left w3-border-right">
<p><a href="twobros.php">Back to Home</a></p>
    
<?php

  @ $db = new mysqli('localhost', 'bookorama', '123456789', 'twobros');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

 if (isset($_POST['delete']) && isset($_POST['apartmentId'])){

    $apartmentId=$_POST['apartmentId'];

    $query = "delete from apartment where apartmentId = '$apartmentId'";
    $result = $db->query($query);

    if ($result) {
        // echo  $db->affected_rows." book deleted from database.";
    } else {
        echo "An error has occurred.  The item was not deleted.";
        exit;
    }
 }

  $query = "select * from apartment";
  $result = $db->query($query);
  
  $num_results = $result->num_rows;

  echo "<p>Total number of records: ".$num_results."</p>";

  for ($i=0; $i <$num_results; $i++) {
    $row = $result->fetch_assoc();
    echo "<p><strong> Street Adress: ";
    echo htmlspecialchars(stripslashes($row['streetAddress']));
    echo "</strong><br />";
    echo "<p> Unit Number: ";
    echo stripslashes($row['unitNumber']);
    echo "<br />";
    echo "<p> Price: ";
    echo stripslashes($row['price']);
    echo "<br />";
    echo "<p> Size: ";
    echo stripslashes($row['size']);
    echo "<br />";
    echo "<p> Views: ";
    echo stripslashes($row['pictures']);
    echo "<br />";
    echo "</p>";


     $apartmentId = $row['apartmentId'];

    // Add Delete buttons and hidden fields for each query result
    echo <<<_END
    <form action="delete_apartment.php" method="post">
    <input tyle='text-align:center;' type="hidden" name="delete" value="yes" />
    <input type="hidden" name="apartmentId" value=$apartmentId />
    <input type="submit" value="DELETE RECORD" /></form>
_END;

  }

  $result->free();
  $db->close();
?>
</body>
</html>
<html>
<head>
  <title>TwoBros Search Results</title>
</head>
<body>
<h1>TwoBros Search Results</h1>
<?php
    $mysqli_link = mysqli_connect('localhost', 'bookorama', '123456789', 'twobros');
    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

   // if(isset($_POST['submit'])) {
        // define the list of fields
        echo "<p>in here </p>";
        $fields = array('streetAddress', 'price', 'size');
        $conditions = array();
        
        // loop through the defined fields
        foreach($fields as $field){
            // if the field is set and not empty
            if(isset($_POST[$field]) && $_POST[$field] != '') {
                // create a new condition while escaping the value inputed by the user (SQL Injection)
                $conditions[] = "`$field` LIKE '%" . $_POST[$field] . "%'";
            }
        }
        // builds the query
        $query = "SELECT * FROM apartments ";
        // if there are conditions defined
        if(count($conditions) > 0) {
            // append the conditions
            $query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
        }
        echo "<p>Query: " . $query . "</p>";

        $result = mysqli_query($mysqli_link, $query) or die(mysql_error());

        $num_results = $result->num_rows;
        echo "<p>Number of books found: " . $num_results . "</p>";
        mysqli_close($mysqli_link);


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
        }
  //  }

    
    

    

    
?>
</body>
</html>
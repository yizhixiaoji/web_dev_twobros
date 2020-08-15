<html>
<title>TwoBros Home Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.mySlides {display: none}
</style>
<body class="w3-content w3-border-left w3-border-right">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-light-grey w3-collapse w3-top" style="z-index:3;width:260px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-transparent w3-display-topright"></i>
    <h3>TwoBros</h3>
    <h3>Affordable Housing for Students in NYC</h3>
    <h6>Search NOW!</h6>
    <hr>
    <form action="" method="post">
      <!--
      <p><label><i class="fa fa-road"></i> Neighborhood</label></p>
      <input class="w3-input w3-border" type="text" placeholder="Manhattan" name="area" required>
      -->

      <!-- 
      <p><label><i class="fa fa-bed"></i> Bedrooms</label></p>
      <input class="w3-input w3-border" type="number" value="1" name="bedroom" min="0" max="6">       
      
      <p><label><i class="fa fa-bath"></i> Bathrooms</label></p>
      <input class="w3-input w3-border" type="number" value="1" name="bathroom" min="0" max="4"> 
      -->
    </form>

    <button onclick="window.location.href='twobros.php'"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Go back to home page</button>

    <button onclick="window.location.href='favolist.php'"><i class="fa fa-heart w3-margin-right"></i>My Favorite List</button>

  </div>
  <div class="w3-bar-block">
    <a href="#apartment" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-building"></i> Apartment</a>
    <a href="#contact" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-envelope"></i> Contact</a>
  </div>
  
  <form action="new_apartment.html" method="get" target="_blank">
         <button type="submit" class="w3-btn w3-block w3-red w3-border">Add New Apartment</button>
  </form>
  <form action="update_apartment.php" method="get" target="_blank">
         <button type="submit" class="w3-btn w3-block w3-red w3-border">Update Apartment</button>
  </form>
  <form action="delete_apartment.php" method="get" target="_blank">
         <button type="submit" class="w3-btn w3-block w3-red w3-border">Delete Apartment</button>
  </form>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <span class="w3-bar-item">Rental</span>
  <a href="javascript:void(0)" class="w3-right w3-bar-item w3-button" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-white" style="margin-left:260px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:80px"></div>

  <!-- Slideshow Header -->
  <div class="w3-container">
    <h2 class="w3-text-red">Our Mission</h2>
    <p><img src="images/logo.png" alt="logo" style="float:left;width:200px;height:110px;"></p>
    <p>We are here to help students find the right place to live, to study and to enjoy the local community here in NYC. We find afforable housing and handle all necessary documentation for our clients. There is nothing to worry about!</p>
  </div> <hr>


  <div class="w3-container" id='apartments'>
    <h2 class="w3-text-red">Your Favorite Apartment Listings</h2>
    <?php
  $mysqli_link = mysqli_connect('localhost', 'bookorama', '123456789', 'twobros');
  // Check connection
  if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
  // builds the query // Please be aware the customerId need to be resolved with variables
  $query0 = "SELECT * FROM apartment WHERE apartmentId IN (SELECT apartmentId FROM user_apt_like where customerId = 10)";

  $result = mysqli_query($mysqli_link, $query0) or die(mysqli_connect_error());

  $num_results = $result->num_rows;
  mysqli_close($mysqli_link);

  for ($i=0; $i <$num_results; $i++) {
    $row = $result->fetch_assoc();
    echo "<p style='margin-left: 1;'><strong> Apartment ID: ";
    echo stripslashes($row['apartmentId']);
    echo "</strong><br>";
    echo "<img src='uploads/".$row['pictures']."' style='float:right;width:220;height:220;'>";
    echo "<br>";
    echo "<p style='margin-left: 1;'> Street Adress: ";
    echo htmlspecialchars(stripslashes($row['streetAddress']));
    echo "<br>";
    echo "<p style='margin-left: 1;'> Unit Number: ";
    echo stripslashes($row['unitNumber']);
    echo "<br>";
    echo "<p style='margin-left: 1;'> Price: ";
    echo stripslashes($row['price']);
    echo "<br>";
    echo "<p style='margin-left: 1;'> Size: ";
    echo stripslashes($row['size']);
    echo "<br>";
    echo "<p style='margin-left: 1;'> Picture: ";
    echo "<br>";
    echo "</p>";
    echo "<hr>";
}

//---------------
  if(isset($_POST['submit-button'])) {
      // define the list of fields
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

      
      
      
     // echo "<p>Query: " . $query . "</p>";
   
     

      
      


      echo "<label><i class='fa fa-building'></i> Apartments found:</label>";
      echo $num_results;
    }
?>

    </div>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar when on tablets and phones
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Slideshow Apartment Images
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>
  
  
  
 
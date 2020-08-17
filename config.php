<?php
/* Creating the Config File */

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'demo');
*/
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect('localhost', 'bookorama', '123456789', 'twobros');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
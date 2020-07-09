<?php
session_start();
include("functions.php");
if(isset($_SESSION["user_id"])) {
	if(isLoginSessionExpired()) {
		header("Location:logout.php?session_expired=1");
	}
}
?>
<html>
<head>
<title>User Login</title>
<style>
body {margin:0;}

.navbar {
  overflow: hidden;
  background-color: #275ca8;
  position: fixed;
  top: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background: #ddd;
  color: black;
}
a:link {
  color: white;
}

/* visited link */


/* mouse over link */
a:hover {
  color: hotpink;
}

/* selected link */
a:active {
  color: blue;
}
.main {
  padding: 16px;
  margin-top: 30px;
  height: 1500px; /* Used in this example to enable scrolling */
}
.numberCircle {
    border-radius: 50%;
    width: 144px;
    height: 144px;
    padding: 42px;

    background: #fff;
    border: 2px solid #666;
    color: #666;
    text-align: center;

    font: 56px Arial, sans-serif;
}
hr{
    color:white;
}
}
</style>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <div class="navbar">
  <a href="#home">Home</a>
  <a href="https://in.000webhost.com/cpanel-login" target="_blank">Webhost</a>
  <a href="https://console.firebase.google.com/" target="_blank">Firebase</a>
  <a href="logout.php">Logout</a>
</div>
<table border="0" cellpadding="10" cellspacing="1" width="100%">
<tr class="tableheader">
<td align="center">User Dashboard</td>
</tr>
<tr class="tablerow">
<td>
<?php
if(isset($_SESSION["user_name"])) {
?>

<?php
//my code goes here
$servername = "localhost";
$username = "id12585906_adil";
$password = "Adil9444";
$database = "id12585906_tapin";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($result = $conn -> query("SELECT * FROM USER_NEW")) {
  echo "Number of Users:  <div class='numberCircle'>" . $result -> num_rows."</div><br>";
      echo"<a href='showUser.php'>Show User's List</a><hr>";
  // Free result set
  $result -> free_result();
}
if ($result = $conn -> query("SELECT * FROM DRIVER_NEW")) {
  echo "Number of Drivers:  <div class='numberCircle'>" . $result -> num_rows."</div><br>";
    echo"<a href='showDriver.php'>Show Drivers's List</a><hr>";

  // Free result set
  $result -> free_result();
}
if ($result = $conn -> query("SELECT * FROM ORDERS")) {
  echo "Number of Orders: <div class='numberCircle'>" . $result -> num_rows."</div>";
  echo"<a href='showOrder.php'>Show Order's List</a><hr>";
  // Free result set
  $result -> free_result();
}
?>
<?php
}
?>
</td>
</tr></table></body></html>
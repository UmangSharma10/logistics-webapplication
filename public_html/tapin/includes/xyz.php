<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>
<table>
<tr>
<th>Id</th>
<th>Username</th>
<th>Password</th>
</tr>
<?php
$conn = mysqli_connect("localhost", "id12585906_adil", "Adil9444", "id12585906_tapin");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT User_Id, Fb_Id, Phone FROM USER_NEW";
$result = $conn->query($sql);
	$products = array(); 
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["User_Id"]. "</td><td>" . $row["Fb_Id"] . "</td><td>"
. $row["Phone"]. "</td></tr>";
		$temp = array();
		$temp['User_Id'] = $row["User_Id"]; 
		$temp['Fb_Id'] = $row["Fb_Id"]; 
		$temp['Phone'] = $row["Phone"]; 
		 
		array_push($products, $temp);
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
	echo json_encode($products);
?>
</body>
</html>
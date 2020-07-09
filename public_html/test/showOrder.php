<!DOCTYPE html>
<html>
<head>
<title>User Details</title>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #435165;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #435165;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>
<table>
<tr>
<th>OrderId</th>
<th>Description</th>
<th>Weight</th>
<th>Receiver Name</th>
<th>Receiver Phone</th>
<th>User Id</th>
<th>Driver Id</th>
<th>Status</th>
</tr>
<?php
$conn = mysqli_connect("localhost", "id12585906_adil", "Adil9444", "id12585906_tapin");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM ORDERS";
$result = $conn->query($sql);
	$products = array(); 
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Order_Id"]. "</td><td>" . $row["Description"] . "</td><td>"
. $row["Weight"]. "</td><td>" . $row["Receiver_Name"]."</td><td>" . $row["Receiver_Phone"]."</td><td>" . $row["User_Id"].
"</td><td>" . $row["Driver_Id"]."</td><td>" . $row["Order_Status"]."</td></tr>";
		$temp = array();
		$temp['Order_Id'] = $row["Order_Id"]; 
		$temp['Description'] = $row["Description"]; 
		$temp['Weight'] = $row["Weight"]; 
		$temp['Receiver_Name'] = $row["Receiver_Name"];
		$temp['Receiver_Phone'] = $row["Receiver_Phone"];
		$temp['User_Id'] = $row["User_Id"];
        $temp['Driver_Id']=$row["Driver_Id"];
        $temp['Order_Status'] = $row["Order_Status"];
		array_push($products, $temp);
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
	
?>
</body>
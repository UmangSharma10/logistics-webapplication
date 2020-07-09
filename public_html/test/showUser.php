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
<th>UserId</th>
<th>FirstName</th>
<th>LastName</th>
<th>Gender</th>
<th>Birthdate</th>
</tr>
<?php
$conn = mysqli_connect("localhost", "id12585906_adil", "Adil9444", "id12585906_tapin");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM USER_NEW";
$result = $conn->query($sql);
	$products = array(); 
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Phone"]. "</td><td>" . $row["Firstname"] . "</td><td>"
. $row["Lastname"]. "</td><td>" . $row["Gender"]."</td><td>" . $row["Dob"]."</td></tr>";
		$temp = array();
		$temp['Phone'] = $row["Phone"]; 
		$temp['Firstname'] = $row["Firstname"]; 
		$temp['Lastname'] = $row["Lastname"]; 
		$temp['Gender'] = $row["Gender"]; 
        $temp['Dob']=$row["Dob"];
		array_push($products, $temp);
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
	
?>
</body>
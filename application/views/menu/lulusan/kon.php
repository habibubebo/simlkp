<?php

// Get the user id
$nipd = $_REQUEST['Nipd'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "db_lkp");

if ($nipd !== "") {
	
	// Get corresponding first name and
	// last name for that user id	
	$query = mysqli_query($con, "SELECT * FROM peserta WHERE Nipd='$nipd'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$nama = $row["Nama"];
	$jk = $row["jk"];
	$ttl = $row["Ttl"];
	$jks = $row["jks"];

	
}

// Store it in a array
$result = array("$nama", "$jk", "$ttl", "$$jks");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>

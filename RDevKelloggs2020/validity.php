<?php
	$Table = "RDevKelloggs2020";
	$servername = "localhost";
	$username = "uhkcjwabf4e2s";
	$password = "9bw3fzvp7pc4";
	$dbname = "dbesr7c6bhzjt8";

	$email = mb_strtolower($_POST['email']);

	$code = "0";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT Email,UPPER(Nombre_Ponente) as nameP,Panel,Downloads FROM $Table WHERE email='$email' AND Data='P'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		global $code;
		$code = "0";
	}else{
		global $code;
		$code = "1";
	}
	echo $code;
?>

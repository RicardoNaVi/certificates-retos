<?php
	$Table = "RDevIBM2020";
	$servername = "localhost";
	$username = "uhkcjwabf4e2s";
	$password = "9bw3fzvp7pc4";
	$dbname = "dbesr7c6bhzjt8";

	ini_set('max_execution_time', 0);
	mb_internal_encoding('UTF-8');
	mb_http_output('UTF-8');
	ini_set('default_charset', 'utf-8');

	$email = mb_strtolower($_POST['email']);
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT Email,UPPER(Name) as nameP,Data,Downloads FROM $Table WHERE email='$email' AND Data='P'";
	$resultado = $conn->query($sql);
	$code = "0";
	if ($resultado -> num_rows > 0) {
		try {
			$row = $resultado -> fetch_assoc();
			$sql = "UPDATE $Table SET Downloads=Downloads+1 WHERE email='$email' AND Data='P'";
			$conn -> query($sql);
			header('Content-Type: image/png');
			header ( "Content-Type: application/force-download" );
			header ( "Content-Type: application/octet-stream" );
			header ( "Content-Type: application/download" );
			header ( "Content-Type: png" );
			header ( "Content-Disposition: attachment; filename=certificado.png" );
			header ( "Content-Transfer-Encoding: binary" );
			header ( "Accept-Ranges: bytes" );
			$im     = imagecreatefrompng("Certificado.png");
			$color = imagecolorallocate($im, 0, 0, 0);
			$px     = (imagesx($im) - 7.5 * strlen($row["nameP"])) / 2;
			//$fuente = "nutmegregular.ttf";
			$fuente = realpath('font/nutmegregular.ttf');
			$font = imageloadfont($fuente);
			$fontwidth = 5;
			$center = (imagesx($im) / 2) - ($fontwidth * (strlen($row["nameP"])/2))*14;
			imagettftext($im, 80, 0, $center, 1340, $color, $fuente, $row["nameP"]);
			imagepng($im);
			$code = "0";
		} catch (Exception $e) {
			//throw $th;
			die($e);
		}	
	}else{
		$code = "1";
	}
	echo $code;
?>
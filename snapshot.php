<?php
  // read input stream
	$data = file_get_contents("php://input");

	$filteredData=substr($data, strpos($data, ",")+1);
	// Need to decode before saving since the data we received is already base64 encoded
	$decodedData=base64_decode($filteredData);

	// store in server
	$fic_name = "cedula.png";
	$fp = fopen('./firmas/'.$fic_name, 'wb');
	$ok = fwrite( $fp, $decodedData);
	fclose( $fp );
	if($ok)
		echo $fic_name;
	else
		echo "ERROR";
?>
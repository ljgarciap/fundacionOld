<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<?php
include_once('bas/conn.php');

mysqli_set_charset($con,"utf8");
	
$result=mysqli_query($con,"SELECT r.documentor,r.nombresr,r.apellidosr,r.eps,r.nomfund,r.codigo,r.fechacodigo,h.fechaingreso from 
residentes r join historial h on r.idresidentes=h.idresidentes where r.estado='A' or r.estado='E' order by nombresr;");

$ordinal=0;
?>
<!-- <body onload="window.print();"> -->
<body>
	<div style="margin-left: 5%">
		<?php
		include 'barcode128.php';

	while ($resultc = mysqli_fetch_array($result)) {
		$documento=$resultc['documentor'];
		$nombres=$resultc['nombresr'];
		$apellidos=$resultc['apellidosr'];
		$nombre = $nombres." ".$apellidos;

			echo "<p class='inline'><span ><b>Item: $product</b></span>".bar128(stripcslashes($documento))."<span ><b>Residente: ".$nombre." </b><span></p>&nbsp&nbsp&nbsp&nbsp";
		}

		?>
	</div>
</body>
</html>
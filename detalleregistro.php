<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$orientador="$nombresess"." "."$apellidosess";
	
include_once('bas/conn.php');
//$idresidente=$_REQUEST['idresidente'];
$idresidente="1";
//se crea el usuario con los datos y luego se crea la asociacion en este mismo archivo

mysqli_set_charset($con,"utf8");
?>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="Fundación Jesús es mi roca"/>
	<meta name="keywords" content="Fundación Jesús es mi roca"/>
	<meta name="author" content="Softclass"/>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">		
	<script src="js/jquery.js"></script> 
	<script src="js/bootstrap.min.js"></script>			<!-- boots -->		

<title>Registro de residente <?php echo $tipodr;echo "&nbsp";echo $cedular; ?></title>

</head>

<body>

<div class="container">
<div class="jumbotron page">

<font face='Arial, Helvetica, sans-serif'>

<p>

<p>

<p><center><h2><u><?php echo $orientador;?></u></h2></center></p><br>
<p><center><h2><u><?php echo $usuariosess;?></u></h2></center></p><br>

<p><center><h2><u>Registro completo</u></h2></center></p><br>
<p>Para ver detalle del registro y/o imprimirlo; por favor clickea sobre el botón generar vista de documento.</p>
<center>
<form id="detalle" action = "detallef.php" method = "post" target="_blank">
<input type="hidden" id="idresidente" name="idresidente" value="<?php echo $idresidente;?>"></input><!--oculto idresidente-->
<div class="wrapper">
<button type="submit" class="btn btn-default">Generar vista de documento</button>          
</div>
</center>
</form>

<form id="detalle" action = "detallej.php" method = "post" target="_blank">
<input type="hidden" id="idresidente" name="idresidente" value="<?php echo $idresidente;?>"></input><!--oculto idresidente-->
<div class="wrapper">
<button type="submit" class="btn btn-default">Generar vista de documento</button>          
</div>
</center>
</form>

</p>

</p>

</div>
</div>

<?php	
}
else {
header("Location:index.php");
}
?>
</body>
</html>
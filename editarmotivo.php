<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

$idh=$_REQUEST["idh"];

include("menusadmin.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");
?>

<style>
.wrapper {
    text-align: center;
}
.btn{
	background-color:#941524;
	border-color:transparent;
	color:white;
	font-size:1.5em;
}
.btn:hover{
	background-color:#523a18;
	border-color:transparent;
	color:white;
}
</style>

<body>
<div class="container">
<div class="jumbotron">
<p><center><h2><u>Adicionar o cambiar motivos de retiro.</u></h2></center></p><br>
<form id="editarm" action = "editarm.php" method = "post">
<?php
$result1=mysqli_query($con,"select residentes.idresidentes as idr, residentes.nomfund as nomfund, residentes.nombresr as nomr, residentes.apellidosr as apelr, historiali.fecharetiro as fecharetiro, historiali.motivo as motivor from residentes join historiali on historiali.idresidentes=residentes.idresidentes where 
historiali.idhistoriali='$idh'");

while ($resultx = mysqli_fetch_array($result1)) {
$idr=$resultx['idr'];
$nomfund=$resultx['nomfund'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$fecharetiro=$resultx['fecharetiro'];
$motivo=$resultx['motivor'];
}
?>
<p>
<div class="row">
<div class="col-md-12">
<label>Motivos de retiro de <?php echo $nomr." ".$apelr." Fecha: ".$fecharetiro; ?></label>
<textarea rows="4" id="motivo" name="motivo" class="form-control input-sm chat-input">
<?php echo $motivo;?></textarea>
</div>
</div>
<br>
<input type="hidden" id="idh" name="idh" value="<?php echo $idh;?>"></input>
<input type="hidden" id="idr" name="idr" value="<?php echo $idr;?>"></input>
<input type="hidden" id="nomfund" name="nomfund" value="<?php echo $nomfund;?>"></input>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Actualizar datos</button>          
</div>
</center>
</form>
</div>
</div>
<?php	
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
</body>
</html>
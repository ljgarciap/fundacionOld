<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$orientador="$nombresess"." "."$apellidosess";
	
include("menusadmin.html");
include_once('bas/conn.php');
$hoy = date("y-m-d");

$nomfund=$_REQUEST['nomfund'];
$fechai=$_REQUEST['fechai'];
$motivo=$_REQUEST['motivo'];
$nombresr=$_REQUEST['nombresr'];
$apellidosr=$_REQUEST['apellidosr'];
$fechan=$_REQUEST['fechan'];
$dia = date("d",strtotime($fechai));
$seguro=$_REQUEST['seguro'];
$direccion=$_REQUEST['direccion'];
$ciudad=$_REQUEST['ciudad'];
$documentor=$_REQUEST['documentor'];
$expedicion=$_REQUEST['expedicion'];
$tipodocr=$_REQUEST['tipodocr'];
$telefonor=$_REQUEST['telefonor'];
$celularr=$_REQUEST['celularr'];
$estudios=$_REQUEST['estudios'];
$profesion=$_REQUEST['profesion'];
$emailr=$_REQUEST['emailr'];
$estadocivil=$_REQUEST['estadocivil'];
$conyuge=$_REQUEST['conyuge'];
$padre=$_REQUEST['padre'];
$madre=$_REQUEST['madre'];
$tiempo=$_REQUEST['tiempo'];
$medida=$_REQUEST['medida'];
$drogas=$_REQUEST['drogas'];
$prob=$_REQUEST['prob'];
$preso=$_REQUEST['preso'];
$fundaciones=$_REQUEST['fundaciones'];
$retiro=$_REQUEST['retiro'];
$referido=$_REQUEST['referido'];
$pension=$_REQUEST['pension'];
$uniforme=$_REQUEST['uniforme'];
$actor="$nombresr"." "."$apellidosr";

//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");

if($nomfund=='3'){
$estado="E";
$nomfund="FUNDACIÓN JESÚS ES MI ROCA";
}
else{
$estado="A";
}

$residentes="INSERT INTO residentes(documentor,expedicionr,fechanacimiento,nombresr,
apellidosr,telefono,celular,profesion,email,estado,direccionf,ciudad,estudios,
estadocivil,conyuge,tipodocumento,eps,padre,madre,nomfund) 
VALUES ('$documentor','$expedicion','$fechan','$nombresr','$apellidosr',
'$telefonor','$celularr','$profesion','$emailr','$estado','$direccion','$ciudad',
'$estudios','$estadocivil','$conyuge','$tipodocr','$seguro','$padre','$madre',
'$nomfund')";

$actores="INSERT INTO actores(nombre) VALUES ('$actor')";

$ultimoresidente="SELECT idresidentes FROM residentes ORDER by idresidentes DESC LIMIT 1";
$result1=mysqli_query($con,"$ultimoresidente");

		while ($resultx = mysqli_fetch_array($result1)) {
		$idresidente=$resultx['idresidentes'];
		$idresidente=($idresidente+1);

$pensiones="INSERT INTO cobrospension(diacobro,valorcobro,idresidentes) 
VALUES ('$dia','$pension','$idresidente')";

$ultimap="SELECT idcobrospension FROM cobrospension ORDER by idcobrospension DESC LIMIT 1";
$resultp=mysqli_query($con,"$ultimap");

		while ($resultxp = mysqli_fetch_array($resultp)) {
		$idcp=$resultxp['idcobrospension'];
		$idcob=($idcp+1);
$abpensiones="INSERT INTO abonopensiones(valorinicial,fechaabono,abono,comentario,idcobrospension) 
VALUES ('$pension','$fechai','0','Pension Inicial','$idcob')";
}

$uniformes="INSERT INTO uniformes(fechacobro,valorcobro,idresidentes) 
VALUES ('$fechai','$uniforme','$idresidente')";
		
$historialesi="INSERT INTO historiali(fechaingreso,idresidentes) VALUES ('$fechai','$idresidente')";
		
$historiales="INSERT INTO historial(fechaingreso,motivoi,tiempoadiccion,medidatiempo,drogasusadas,problemas,carcel,
fundaciones,motivos,referido,orientador,cedorientador,idresidentes) VALUES ('$fechai','$motivo','$tiempo','$medida','$drogas','$prob','$preso','$fundaciones','$retiro','$referido','$orientador','$usuariosess','$idresidente')";	
		}		
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

<script type="text/javascript">
$(function() {
            $("#documentoa").autocomplete({
			maxShowItems: 5,
                source: "usuariosd.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
		
			     }
            });
		});
</script>		<!-- boots -->

<body>

<div class="container">
<div class="jumbotron">
<p><center><h2><u>Formulario de Ingreso del Residente</u></h2></center></p><br>
<p>Bienvenido a <?php echo $nomfund; ?>; por favor llene este formulario de manera precisa, es muy importante para nosotros tener esta información para poder brindar el mejor cuidado posible para usted o para su familiar. Su privacidad es importante para nosotros. La información que comparte con nosotros permanecerá estrictamente confidencial.</p>
<p><center><h2><u>Información del acudiente</u></h2></center></p><br>
<form id="acudiente" action = "registro.php" method = "post">
<p>

<div class="row">
<div class="col-md-6">
<label>Nombres:</label>
<input type="text" id="nombresa" name="nombresa" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del acudiente" style="text-transform: uppercase;" required/></div>
<div class="col-md-6">
<label>Apellidos:</label>
<input type="text" id="apellidosa" name="apellidosa" class="form-control input-sm chat-input" placeholder="Ingrese los apellidos del acudiente" style="text-transform: uppercase;" required/>
</div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<label>Número documento:</label>
<input type="number" id="documentoa" name="documentoa" class="form-control input-sm chat-input" placeholder="Ingrese el documento" required/>
</div>
<div class="col-md-4">
<label>Expedido en:</label>
<select id="expedido" name="expedido" class="form-control input-sm chat-input">
  <option value="PIEDECUESTA" selected>PIEDECUESTA</option>
<?php
$selectciudad=mysqli_query($con,"select DETALLE_CIUDADES as ciudad FROM ciudades order by DETALLE_CIUDADES asc");
		while ($resultc = mysqli_fetch_array($selectciudad)) {
		$sciudad=$resultc['ciudad'];
		echo "<option value='$sciudad'>$sciudad</option>";
		}
?>
</select>
</div>
<div class="col-md-4">
<label>Teléfono:</label>
<input type="number" id="celulara" name="celulara" class="form-control input-sm chat-input" placeholder="Ingrese el número de celular o fijo" required/>
</div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<label>Correo:</label>
<input type="text" id="emaila" name="emaila" class="form-control input-sm chat-input" placeholder="Ingrese un correo electrónico"></input>
</div>
<div class="col-md-4">
<label>Parentesco con el residente:</label>
<input type="text" id="parentesco" name="parentesco" class="form-control input-sm chat-input" placeholder="Ingrese el parentesco" style="text-transform: uppercase;"></input>
</div>
<div class="col-md-4">
<label>Autorización:</label>
<select id="autorizo" name="autorizo" class="form-control input-sm chat-input">
<option value="SI">SI autorizo el uso de imágenes en diversos medios.</option>
<option value="NO">NO autorizo el uso de imágenes en diversos medios.</option>
</select>
</div>
</div>
<br>

</p>
<input type="hidden" id="idresidente" name="idresidente" value="<?php echo $idresidente;?>"></input><!--oculto idresidente-->
<input type="hidden" id="nomfund" name="nomfund" value="<?php echo $nomfund;?>"></input><!--oculto nombre fundacion-->

<input type="hidden" id="residentes" name="residentes" value="<?php echo $residentes;?>"></input><!--oculto query residentes-->
<input type="hidden" id="actores" name="actores" value="<?php echo $actores;?>"></input><!--oculto query actores-->
<input type="hidden" id="ultimoresidente" name="ultimoresidente" value="<?php echo $ultimoresidente;?>"></input><!--oculto ultimoresidente-->
<input type="hidden" id="pensiones" name="pensiones" value="<?php echo $pensiones;?>"></input><!--oculto query pensiones-->
<input type="hidden" id="abpensiones" name="abpensiones" value="<?php echo $abpensiones;?>"></input><!--oculto query abonopensiones-->
<input type="hidden" id="uniformes" name="uniformes" value="<?php echo $uniformes;?>"></input><!--oculto query uniformes-->
<input type="hidden" id="historialesi" name="historialesi" value="<?php echo $historialesi;?>"></input><!--oculto query historialesi-->
<input type="hidden" id="historiales" name="historiales" value="<?php echo $historiales;?>"></input><!--oculto query historiales-->


<?php
/*
echo $residentes;
echo "<br>";
echo $actores;
echo "<br>";
echo $pensiones;
echo "<br>";
echo $abpensiones;
echo "<br>";
*/
?>

<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Guardar y continuar</button>          
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
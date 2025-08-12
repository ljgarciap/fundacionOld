<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

$idresidentes=$_REQUEST['idt'];

header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menuplanta.html");

$hoy = date("y-m-d");
$fecham="20$hoy"; 

mysqli_set_charset($con,"utf8");

$queryu="select * from historiaclinica where idresidentes='$idresidentes'";	

$result1=mysqli_query($con,$queryu);
?>
<div class="container">
<div class="jumbotron">
<?php
if(mysqli_num_rows ($result1)>0){

while ($resultax = mysqli_fetch_array($result1)) {
$idhistoriaclinica=$resultax['idhistoriaclinica'];
$genero=$resultax['genero'];
$lugarnacimiento=$resultax['lugarnacimiento'];
$fechaingreso=$resultax['fechaingreso'];
$remitido=$resultax['remitido'];
$motivoconsulta=$resultax['motivoconsulta'];
$descripcion=$resultax['descripcion'];
$amedicos=$resultax['amedicos'];
$afamiliares=$resultax['afamiliares'];
$apersonales=$resultax['apersonales'];
$condiciones=$resultax['condiciones'];
$aspectos=$resultax['aspectos'];
$tipologia=$resultax['tipologia'];
$observaciones=$resultax['observaciones'];
$personal=$resultax['personal'];
$social=$resultax['social'];
$educativa=$resultax['educativa'];
$afectiva=$resultax['afectiva'];
$estrategias=$resultax['estrategias'];
$observacionesgen=$resultax['observacionesgen'];
$impresion=$resultax['impresion'];
$plan=$resultax['plan'];
$orientador=$resultax['orientador'];

$cedorientador=$resultax['cedorientador'];
$idresidentes=$resultax['idresidentes'];
}

$queryre="select residentes.nombresr as nombresr,residentes.apellidosr as apellidosr,residentes.estado as estado,residentes.documentor as documentor,residentes.expedicionr as expedicionr,residentes.fechanacimiento as fechan,
residentes.estudios as estudios,residentes.profesion as profesion,residentes.direccionf as direccionf,residentes.telefono as telefono,residentes.celular as celular,residentes.eps as eps,historial.fechaingreso as fechai,
YEAR(residentes.fechanacimiento) as annon from residentes join historial on residentes.idresidentes=historial.idresidentes where residentes.idresidentes='$idresidentes'";	

$resultre=mysqli_query($con,$queryre);

while ($resultare = mysqli_fetch_array($resultre)) {
$nomr=$resultare['nombresr'];
$aper=$resultare['apellidosr'];
$cedr=$resultare['documentor'];
$expedicionr=$resultare['expedicionr'];
$nacido=$resultare['annon'];
$telefono=$resultare['telefono'];

$celular=$resultare['celular'];
$fechai=$resultare['fechai'];
$fechan=$resultare['fechan'];

$profesion=$resultare['profesion'];
$estudios=$resultare['estudios'];
$direccionf=$resultare['direccionf'];
$eps=$resultare['eps'];

$nombre=$nomr." ".$aper;
$telefonos=$telefono." - ".$celular;

$hoy=date("Y");		
$edad=$hoy-$nacido;
}

$queryb="select * from ciudades where ID_CIUDADES='$lugarnacimiento'";	

$resultb1=mysqli_query($con,$queryb);

while ($resultaxb = mysqli_fetch_array($resultb1)) {
$ciudadn=$resultaxb['DETALLE_CIUDADES'];
}

$querya="select * from historiaclinica where idresidentes='$idresidentes'";	

$resulta1=mysqli_query($con,$querya);

while ($resultaxa = mysqli_fetch_array($resulta1)) {
$idhistoriaclinica=$resultaxa['idhistoriaclinica'];
}
?>

<p><center><h2><u>GENERALIDADES ACOMPAÑAMIENTO</u></h2></center></p><br>
<p>
<div class="row">
<div class="col-md-1">
<label>CONS:</label>
<input type="text" id="cons" name="cons" class="form-control input-sm chat-input" value='<?php echo $idhistoriaclinica;?>' readonly/>
</div>
<div class="col-md-2">
<label>Fecha realización:</label>
<input type="date" id="fecha" name="fecha" class="form-control input-sm chat-input" value='<?php echo $fechaingreso;?>' readonly/>
</div>
<div class="col-md-2">
<label>Fecha ingreso:</label>
<input type="date" id="fechai" name="fechai" class="form-control input-sm chat-input" value='<?php echo $fechai;?>' readonly/>
</div>
<div class="col-md-4">
<label for="nombre">Residente:</label>
<input type="text" id="nomb" name="nomb" class="form-control input-sm chat-input" value="<?php echo $nombre;?>" readonly/></div>
<div class="col-md-3">
<label for="remitido">Remitido:</label>
<input type="text" id="remitido" name="remitido" class="form-control input-sm chat-input" placeholder="Remitido por" value='<?php echo $remitido;?>' readonly/></div>
</div>
<br>
<h3>DATOS DE IDENTIFICACIÓN</h3><br>
<div class="row">
<div class="col-md-2">
<label>Documento:</label>
<input type="text" id="cedula" name="cedula" class="form-control input-sm chat-input" value='<?php echo $cedr;?>' readonly/></div>
<div class="col-md-2">
<label>Expedido:</label>
<input type="text" id="expedido" name="expedido" class="form-control input-sm chat-input" value='<?php echo $expedicionr;?>' readonly/></div>
<div class="col-md-2">
<label for="fechan">Fecha nacimiento:</label>
<input type="date" id="fechan" name="fechan" class="form-control input-sm chat-input"  value='<?php echo $fechan;?>' readonly/></div>
<div class="col-md-3">
<label>Lugar nacimiento:</label>
<input type="text" id="ciudadn" name="ciudadn" class="form-control input-sm chat-input" value='<?php echo $ciudadn;?>' readonly/>
</div>
<div class="col-md-1">
<label>Edad:</label>
<input type="text" id="edad" name="edad" class="form-control input-sm chat-input" value='<?php echo $edad;?>' readonly/></div>
<div class="col-md-2">
<label for="genero">Genero:</label>
<input type="text" id="genero" name="genero" class="form-control input-sm chat-input"   value='<?php echo $genero;?>' readonly/></div>
</div>
<br>

<div class="row">
<div class="col-md-1">
<label>Escolaridad:</label>
<input type="text" id="escolaridad" name="escolaridad" class="form-control input-sm chat-input" value='<?php echo $estudios;?>' readonly/></div>
<div class="col-md-2">
<label>Oficio:</label>
<input type="text" id="oficio" name="oficio" class="form-control input-sm chat-input"value='<?php echo $profesion;?>' readonly/></div>
<div class="col-md-4">
<label for="direccion">Dirección:</label>
<input type="text" id="direccion" name="direccion" class="form-control input-sm chat-input" value='<?php echo $direccionf;?>' readonly/></div>
<div class="col-md-2">
<label>Teléfono:</label>
<input type="text" id="telefono" name="telefono" class="form-control input-sm chat-input" value='<?php echo $telefonos;?>' readonly/></div>
<div class="col-md-3">
<label>Seguro social:</label>
<input type="text" id="eps" name="eps" class="form-control input-sm chat-input" value='<?php echo $eps;?>' readonly/></div>
</div>
<br>

<h3>GENERALIDADES</h3><br>
<div class="row">
<div class="col-md-6">
<label>Motivo de consulta:</label>
<textarea id="motivoconsulta" name="motivoconsulta" rows="6" class="form-control input-sm chat-input" readonly/><?php echo $motivoconsulta; ?></textarea></div>
<div class="col-md-6">
<label>Descripción de la situación actual:</label>
<textarea id="descripcion" name="descripcion" rows="6" class="form-control input-sm chat-input" readonly/><?php echo $descripcion;?></textarea></div>
</div>
<br>

<h3>ANTECEDENTES</h3><br>
<div class="row">
<div class="col-md-6">
<label>Antecedentes Médicos, Psicológicos y Psiquiátricos</label>
<textarea id="amedicos" name="amedicos" rows="4" class="form-control input-sm chat-input" readonly/><?php echo $amedicos;?></textarea></div>
<div class="col-md-6">
<label>Antecedentes Familiares</label>
<textarea id="afamiliares" name="afamiliares" rows="4" class="form-control input-sm chat-input" readonly/><?php echo $afamiliares;?></textarea></div>
</div>
<br>
<div class="row">
<div class="col-md-4">
<label>Antecedentes Personales</label>
<textarea id="apersonales" name="apersonales" rows="7" class="form-control input-sm chat-input" readonly/><?php echo $apersonales;?></textarea></div>
<div class="col-md-4">
<label>Factores Prenatales y nacimiento</label>
<textarea id="condiciones" name="condiciones" rows="7" class="form-control input-sm chat-input" readonly/><?php echo $condiciones;?></textarea></div>
<div class="col-md-4">
<label>Aspectos Relevantes del desarrollo</label>
<textarea id="aspectos" name="aspectos" rows="7" class="form-control input-sm chat-input" readonly/><?php echo $aspectos;?></textarea></div>
</div>
<br>

<h3>AREAS DE FUNCIONAMIENTO</h3><br>
<h4>AREA FAMILIAR</h4><br>
<div class="row">
<div class="col-md-6">
<label>Tipologia familiar</label>
<input type="text" id="tipologia" name="tipologia" rows="4" class="form-control input-sm chat-input" value='<?php echo $tipologia;?>' readonly/></div>
<div class="col-md-6">
<label>Genograma</label><br>
<a href="genograma.php" target="blank">Ver genograma</a></div>
</div>
<br>
<div class="row">
<div class="col-md-6">
<label>Observaciones</label>
<textarea id="observaciones" name="observaciones" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" readonly/><?php echo $observaciones;?></textarea></div>
<div class="col-md-6">
<label>Area Personal</label>
<textarea id="personal" name="personal" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" readonly/><?php echo $personal;?></textarea></div>
</div>
<br>
<div class="row">
<div class="col-md-4">
<label>Área Social</label>
<textarea id="social" name="social" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" readonly/><?php echo $social;?></textarea></div>
<div class="col-md-4">
<label>Área Educativa / Ocupacional</label>
<textarea id="educativa" name="educativa" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" readonly/><?php echo $educativa;?></textarea></div>
<div class="col-md-4">
<label>Área Afectiva</label>
<textarea id="afectiva" name="afectiva" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" readonly/><?php echo $afectiva;?></textarea></div>
</div>
<br>

<div class="row">
<div class="col-md-6">
<label>PROCESO DE ACOMPAÑAMIENTO PSICOLOGICO</label>
<textarea id="estrategias" name="estrategias" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" readonly/><?php echo $estrategias;?></textarea></div>
<div class="col-md-6">
<label>OBSERVACIONES GENERALES </label>
<textarea id="observacionesgen" name="observacionesgen" rows="4" class="form-control input-sm chat-input" readonly/><?php echo $observacionesgen;?></textarea></div>
</div>
<br>
<div class="row">
<div class="col-md-6">
<label>IMPRESIÓN DIAGNÓSTICA</label>
<textarea id="impresion" name="impresion" rows="4" class="form-control input-sm chat-input" readonly/><?php echo $impresion;?></textarea></div>
<div class="col-md-6">
<label>PLAN DE ACOMPAÑAMIENTO PSICOLOGICO</label>
<textarea id="plan" name="plan" rows="4" class="form-control input-sm chat-input" readonly/><?php echo $plan;?></textarea></div>
</div>
<br>
</p>

<?php
}
else{
?>
<center><h2>
<a href="historia.php" target="blank">
No existe historia, click para abrir nueva</a>
</h2></center>
<?php	
}
?>

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

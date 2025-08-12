<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include_once('bas/conn.php');
include("menusadmin.html");
$hoy = date("y-m-d"); 

$idresidentes=$_REQUEST['idr'];

mysqli_set_charset($con,"utf8");

$query="select nombresr,apellidosr from residentes where idresidentes='$idresidentes'";
$result=mysqli_query($con,"$query");
while ($resultx = mysqli_fetch_array($result)) {

$nomr=$resultx['nombresr'];
$apelr=$resultx['apellidosr'];
$nombre="$nomr"." "."$apelr";
}
?>
<div class="container">
<div class="jumbotron">

<center><h3>Historial del residente <?php echo $nombre; ?></h3></center>
<br><hr>
<center><h3>Histórico de ingresos</h3></center>
<?php
$query0="select * from historiali where idresidentes='$idresidentes' order by fechaingreso asc;";
$result0=mysqli_query($con,"$query0");
?>	
<table class="table" border="2"><thead>
    <tr>
<th>Fecha ingreso</th>
<th>Fecha retiro</th>
<th>Motivo</th>
    </tr>
</thead>
<?php	
while ($resultx0 = mysqli_fetch_array($result0)) {
$fecha0=$resultx0['fechaingreso'];
$evaluacion0=$resultx0['fecharetiro'];
$trabajo0=$resultx0['motivo'];
?>
<tr>
<td><?php echo "$fecha0"; ?></td>
<td><?php echo "$evaluacion0"; ?></td>
<td><?php echo "$trabajo0"; ?></td>
</tr>
<?php
}
?>
</table>

<br><hr>
<center><h3>Estado de cuenta</h3></center>
<?php
$ultimovalor="SELECT sum(valorinicial) as valoriniciales,sum(abono) as abonos  FROM abonopensiones join cobrospension 
on abonopensiones.idcobrospension=cobrospension.idcobrospension where cobrospension.idresidentes='$idresidentes'";
$resultv1=mysqli_query($con,"$ultimovalor");

		while ($resultvx = mysqli_fetch_array($resultv1)) {
		$valoriniciales=$resultvx['valoriniciales'];
		$abonos=$resultvx['abonos'];
}
$saldos=($valoriniciales-$abonos);
?>	
<table class="table" border="2"><thead>
<tr>
<td>Fecha actual : <?php echo "20$hoy"; ?></td>
<?php
if($saldos>0){
?>
<td style="color:red;">Valor pendiente : <b><?php echo "$saldos"; ?></b></td>
<?php	
}
else{
?>
<td>Valor pendiente : <?php echo "$saldos"; ?></td>
<?php	
}
?>
</tr>
</table>
<br><hr>

<center><h3>Reportes fundador</h3></center>
<?php
$query1="select terapialider.fecha as fecha,terapialider.evaluacion as evaluacion,terapialider.trabajo as trabajo,terapialider.tarea as tarea, from terapialider join residentes on terapialider.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidentes' order by terapialider.fecha asc;";
$result1=mysqli_query($con,"$query1");
if(@mysqli_num_rows($result1)>0){
?>	
<table class="table" border="2"><thead>
    <tr>
<th>Fecha</th>
<th>Evaluación</th>
<th>Trabajo</th>
<th>Tarea</th>
    </tr>
</thead>
<?php	
while ($resultx1 = mysqli_fetch_array($result1)) {
$fecha1=$resultx1['fecha'];
$evaluacion1=$resultx1['evaluacion'];
$trabajo1=$resultx1['trabajo'];
$tarea1=$resultx1['tarea'];
?>
<tr>
<td><?php echo "$fecha1"; ?></td>
<td><?php echo "$evaluacion1"; ?></td>
<td><?php echo "$trabajo1"; ?></td>
<td><?php echo "$tarea1"; ?></td>
</tr>
<?php
}
?>
</table>
<?php
}
else{echo "<h4>No existen registros.</h4>";}
?>
<br><hr>
<center><h3>Reportes psicólogo</h3></center>
<?php
$query2="select seguimientos.fecha as fecha,seguimientos.resumen as resumen,seguimientos.evaluacion as evaluacion,seguimientos.tecnicas as tecnicas,seguimientos.tarea as tarea,seguimientos.idusuarios as prof from seguimientos join residentes on seguimientos.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidentes' order by seguimientos.fecha asc";
$result2=mysqli_query($con,"$query2");
if(@mysqli_num_rows($result2)>0){
?>	
<table class="table" border="2" style="border:solid;">
<thead>
    <tr>
<th>Fecha</th>
<th>Resumen</th>
<th>Evaluación</th>
<th>Técnicas</th>
<th>Tarea</th>
    </tr>
</thead>
<?php	
while ($resultx2 = mysqli_fetch_array($result2)) {
$fecha2=$resultx2['fecha'];
$resumen2=$resultx2['resumen'];
$evaluacion2=$resultx2['evaluacion'];
$tecnicas2=$resultx2['tecnicas'];
$tarea2=$resultx2['tarea'];
$prof2=$resultx2['prof'];

$queryp2="select nombres,apellidos from usuarios where idusuarios='$prof2'";
$resultp2=mysqli_query($con,"$queryp2");
while ($resultxp2 = mysqli_fetch_array($resultp2)) {
$nombres2=$resultxp2['nombres'];
$apellidos2=$resultxp2['apellidos'];
$psicologo=$nombres2." ".$apellidos2;
}
?>
<tr style="border:solid;">
<td><?php echo "$fecha2"; ?><br>Acompañamiento realizado por : <?php echo "$psicologo"; ?></td>
<td><?php echo "$resumen2"; ?></td>
<td><?php echo "$evaluacion2"; ?></td>
<td><?php echo "$tecnicas2"; ?></td>
<td><?php echo "$tarea2"; ?></td>
</tr>
<?php
}
?>
</table>
<?php
}
else{echo "<h4>No existen registros.</h4>";}
?>
<br><hr>
<center><h3>Reportes practicantes</h3></center>
<?php
$query3="select terapiae.fecha as fecha,terapiae.resumen as resumen,terapiae.evaluacion as evaluacion,terapiae.tecnicas as tecnicas,terapiae.tarea as tarea,terapiae.idusuarios as profp from terapiae join residentes on terapiae.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidentes' order by terapiae.fecha asc;";

$result3=mysqli_query($con,"$query3");
if(@mysqli_num_rows($result3)>0){
?>	
<table class="table" border="2" style="border:solid;">
<thead>
    <tr>
<th>Fecha</th>
<th>Resumen</th>
<th>Evaluación</th>
<th>Técnicas</th>
<th>Tarea</th>
    </tr>
</thead>
<?php	
while ($resultx3 = mysqli_fetch_array($result3)) {
$fecha3=$resultx3['fecha'];
$resumen3=$resultx3['resumen'];
$evaluacion3=$resultx3['evaluacion'];
$tecnicas3=$resultx3['tecnicas'];
$tarea3=$resultx3['tarea'];
$prof3=$resultx3['profp'];

$queryp3="select nombres,apellidos from usuarios where idusuarios='$prof3'";
$resultp3=mysqli_query($con,"$queryp3");
while ($resultxp3 = mysqli_fetch_array($resultp3)) {
$nombres3=$resultxp3['nombres'];
$apellidos3=$resultxp3['apellidos'];
$practicante=$nombres3." ".$apellidos3;
}
?>
<tr style="border:solid;">
<td><?php echo "$fecha3"; ?><br>Acompañamiento realizado por : <?php echo "$practicante"; ?></td>
<td><?php echo "$resumen3"; ?></td>
<td><?php echo "$evaluacion3"; ?></td>
<td><?php echo "$tecnicas3"; ?></td>
<td><?php echo "$tarea3"; ?></td>
</tr>
<?php
}
?>
</table>
<?php
}
else{echo "<h4>No existen registros.</h4>";}
?>
<br><hr>
<center><h3>Reportes confrontaciones</h3></center>
<?php
$queryc="select terapiac.fecha as fecha,terapiac.fallas as fallas,terapiac.observaciones as observaciones,terapiac.ayudas as ayudas from terapiac join residentes on terapiac.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidentes' order by terapiac.fecha asc;";

$resultc=mysqli_query($con,"$queryc");
if(@mysqli_num_rows($resultc)>0){
?>	
<table class="table" border="2" style="border:solid;">
<thead>
    <tr>
<th>Fecha</th>
<th>Fallas</th>
<th>Observaciones</th>
<th>Ayudas</th>
    </tr>
</thead>
<?php	
while ($resultxc = mysqli_fetch_array($resultc)) {
$fechac=$resultxc['fecha'];
$evaluacionc=$resultxc['fallas'];
$trabajoc=$resultxc['observaciones'];
$tareac=$resultxc['ayudas'];
?>
<tr style="border:solid;">
<td><?php echo "$fechac"; ?></td>
<td><?php echo "$evaluacionc"; ?></td>
<td><?php echo "$trabajoc"; ?></td>
<td><?php echo "$tareac"; ?></td>
</tr>
<?php
}
?>
</table>
<?php
}
else{echo "<h4>No existen registros.</h4>";}
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
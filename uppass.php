<?php
$oldpass=MD5($_REQUEST['oldpass']);
$newpass=MD5($_REQUEST['newpass']);
$cod=$_REQUEST['cod'];
$pag=$_REQUEST['pag'];
$url="$pag.php";

include_once('bas/conn.php');

mysqli_set_charset($con,"utf8");

$query2="select usuarios.idusuarios from usuarios join validacion on usuarios.idusuarios=validacion.idusuarios where usuarios.documento='$cod'";
$result2=mysqli_query($con,"$query2");
		while ($resultx = mysqli_fetch_array($result2)) {
		$idusuarios=$resultx['idusuarios'];
		}

$query="UPDATE validacion SET password='$newpass' WHERE idusuarios='$idusuarios'";

$result=mysqli_query($con,"$query");

if ($result) {
?>	
<script>
var variable='<?php echo$url;?>'
alert("Contraseña actualizada con éxito");
window.location = variable;
</script>
<?php
}	
else{
?>	
<script>
var variable='<?php echo$url;?>'
alert("No se halló coincidencia, por favor verifique sus datos");
window.location = variable;
</script>
<?php
}	

mysql_close($con);
?>
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");
?>

<div class="container">
<div class="jumbotron">
	<center><h2>Subir Firmas</h2></center>
	<center><p>Por favor escoja la imagen de firma a cargar identificada con el número de cédula indicado desde su carpeta de descargas.</p></center>
        <form action="subir.php" method="POST" enctype="multipart/form-data">
            <table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000">
                <tr>
                    <td height="235" align="center" valign="middle" bgcolor="#FFFFFF">
                        <div align="center">
                            <input name="imagen" type="file" maxlength="150">
                            <br><br>                                     
                            <input type="submit" class="btn-success" value="Agregar" name="enviar" style="cursor: pointer">
                        </div>
                    </td>
                </tr>
            </table>
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
<?php
$nombre = $_FILES['imagen']['name'];
$nombrer = strtolower($nombre);
$cd=$_FILES['imagen']['tmp_name'];
$ruta = "firmas/" . $_FILES['imagen']['name'];
$destino = "firmas/".$nombrer;
$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

header("Location:listado.php");
?>
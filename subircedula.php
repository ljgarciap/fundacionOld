<?php
$nombre = $_FILES['imagen']['name'];
$nombrer = strtolower($nombre);
$cd=$_FILES['imagen']['tmp_name'];
$ruta = "cedulas/" . $_FILES['imagen']['name'];
$destino = "cedulas/".$nombrer;
$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

header("Location:listado.php");
?>
<HTML>
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["minuta"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include("menuminuta.html");
include_once('bas/conn.php');
$fecha = date("y-m-d");
$hoy="20$fecha";
?>
<HEAD>
  <script type="text/javascript">
$(function() {
            $("#docuX").autocomplete({
			maxShowItems: 5,
                source: "visitantes.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
                    $('#docuX').val(ui.item.documento);
					$('#nomX').val(ui.item.nombres);
					$('#apelX').val(ui.item.apellidos);
			     }
            });
		});
</script>
  <script type="text/javascript">
$(function() {
            $("#nomX").autocomplete({
			maxShowItems: 5,
                source: "visitantesb.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
                    $('#docuX').val(ui.item.documento);
					$('#nomX').val(ui.item.nombres);
					$('#apelX').val(ui.item.apellidos);
			     }
            });
		});
</script>
  <script type="text/javascript">
$(function() {
            $("#apelX").autocomplete({
			maxShowItems: 5,
                source: "visitantesc.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
                    $('#docuX').val(ui.item.documento);
					$('#nomX').val(ui.item.nombres);
					$('#apelX').val(ui.item.apellidos);
			     }
            });
		});
</script>
  <script type="text/javascript">
$(function() {
            $("#resX").autocomplete({
			maxShowItems: 5,
                source: "residentesb.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
					$('#resX').val(ui.item.nombrer);
					$('#idresX').val(ui.item.idresidentes);
			     }
            });
		});
</script>
</HEAD>

  <div class="container">  
<div class="jumbotron">
<body>
<center><h2>Minuta para la fecha <?php echo $hoy; ?></h2></center>
<form id="crearminutae" action = "crearminutae.php" method = "get"> 
<div>
  <label>Documento del visitante:</label><input type="text" id="docuX" name="docuX" class="form-control input-sm chat-input"></input>
  <label>Nombres del visitante:</label><input type="text" id="nomX" name="nomX" class="form-control input-sm chat-input"></input>
  <label>Apellidos del visitante:</label><input type="text" id="apelX" name="apelX" class="form-control input-sm chat-input"></input>
  <label>Residente:</label><input type="text" id="resX" name="resX" class="form-control input-sm chat-input"></input>
  <input type="hidden" id="idresX" name="idresX"></input>
</div>
  <label>Asunto:</label><input type="text" id="asunto" name="asunto" class="form-control input-sm chat-input"></input><br>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-warning">Guardar y continuar</button>          
</div>
</center>
</form>
</div>
</div>

</body>
</html>
<?php
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
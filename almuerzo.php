<HTML>
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include("menusadmin.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$fecha = date("y-m-d");
$hoy="20$fecha";
?>
<!--
<HEAD>
  <script type="text/javascript">
$(function() {
            $("#nombrer").autocomplete({
			maxShowItems: 5,
                source: "residentesa.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
					$('#nombrer').val(ui.item.nombrer);
					$('#saldot').val(ui.item.saldototal);
					$('#idresidente').val(ui.item.idresidentes);
			     }
            });
		});
</script>
</HEAD>
-->
<body>

  <div class="container">  
	
	<div class="jumbotron">
<!--		
		<center><h2>Ventas almuerzos</h2></center>

		<form id="almuerzos" action = "almacenar.php" method = "post" >
		
		<div class="row ui-widget">
	
			<div class="col-md-2">
				<label for="fechaf">Fecha</label>
				<input type="date" class="form-control input-sm" id="fechaf" name="fechaf" value="<?php echo $hoy;?>" readonly/>	
			</div>
			
			<div class="col-md-4">
				<label for="nombrer">Nombre</label>
				<input type="text" id="nombrer" name="nombrer" class="form-control input-sm chat-input" placeholder="Nombre cliente" required/>
            <br>
			</div>
			
			<div class="col-md-2">
				<label for="saldot">Saldo</label>
				<input type="text" id="saldot" name="saldot" class="form-control input-sm chat-input" placeholder="saldo cliente" readonly="" />
            <br>
			</div>			

			<div class="col-md-2">
				<label for="valor">Valor</label>
				<input type="text" id="valor" name="valor" class="form-control input-sm chat-input" placeholder="valor almuerzo" required/>
            <br>
			</div>
		
			<input type="hidden" id="idresidente" name="idresidente" value="">	
			
			<div class="col-md-2"><br>
				<button type="submit" class="btn btn-primary">Facturar</button>         
			</div>
	
		</form>
	
		</div>	

<hr style="background: red; height: 3px; width: 100%; border: 0">
-->
		<form id="almuerzos" action = "almacenar.php" method = "post" >
		
		<div class="row ui-widget">
	
			<div class="col-md-2">
				<label for="fechaf">Fecha</label>
				<input type="date" class="form-control input-sm" id="fechaf" name="fechaf" value="<?php echo $hoy;?>" readonly/>	
			</div>
			
			<div class="col-md-6">
				<label for="idresidentes">Nombre</label>
				<select id="idresidentes" name="idresidentes" class="form-control input-sm chat-input">
<?php            
$result1=mysqli_query($con,"select idresidentes,nombresr,apellidosr from residentes 
	where residentes.estado='A'or residentes.estado='E' order by nombresr asc");

while ($resultx = mysqli_fetch_array($result1)) {
$idresidentes=$resultx['idresidentes'];
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
?>
					<option value="<?php echo $idresidentes; ?>"><?php echo $nombresr.' '.$apellidosr; ?></option>
<?php
}            
?>		
				</select>
            <br>
			</div>
			
			<div class="col-md-2">
				<label for="valor">Valor</label>
				<input type="text" id="valor" name="valor" class="form-control input-sm chat-input" placeholder="valor almuerzo" required/>
            <br>
			</div>
		
			<div class="col-md-2"><br>
				<button type="submit" class="btn btn-danger">Facturar</button>         
			</div>
	
		</form>
	
		</div>	

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

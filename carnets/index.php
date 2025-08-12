<html>
	<head>
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="pragma" content="no-cache">

		<link rel="stylesheet" href="bootstrap.min.css?random=<?php echo Rand() ?>">
      <script src="bootstrap.min.js?random=<?php echo Rand() ?>"></script>

		<script type="text/javascript" src="jquery.js?random=<?php echo Rand() ?>"></script>
		
		<script type="text/javascript">
		$('document').ready(function()
		{
		 $(".select-all").click(function () 
		 {
		  $('.chk-box').attr('checked', this.checked)
		 });
		  
		 $(".chk-box").click(function()
		 {
		  if($(".chk-box").length == $(".chk-box:checked").length) 
		  {
		   $(".select-all").attr("checked", "checked");
		  } 
		  else 
		  {
		   $(".select-all").removeAttr("checked");
		  }
		 });
		});
		</script>
		</head>

		<body>

		<?php

		include_once('bas/conn.php');

		mysqli_set_charset($con,"utf8");
		?>
		
		<div class="container">
		
		<center><h1>Generador de carnets</h1>
		<div class="alert alert-info" role="alert">
	  Puede seleccionar todos con un solo botón o escoger uno a uno los que requiera y luego dar click en generar.
		</div><br>
		</center>
		
		<form id="carnets" action = "especificos.php" method="post">	
		
		<table class="items" width="100%" height="100%" cellpadding="8" border="0">
			<thead>
				<tr>
					<td><b>Número</b></td><td><b>Selección</b></td><td><b>Residente</b></td><td><b>Fundación</b></td>
				</tr>
			</thead>
			
			<tbody>
			
			<tr>
				<td></td>
				<td><input type="checkbox" class="select-all" /></td>
				<td><label style="color:red;"><b>SELECCIONAR / DESELECCIONAR TODOS</b></label></td>
			</tr>
			
			<?php
			$query="SELECT r.idresidentes as idresidentes,upper(concat(r.nombresr,' ',r.apellidosr)) as nombre,r.nomfund as nomfund 
			from residentes r where r.estado='A' or r.estado='E' order by nombresr asc";
				
			$result=mysqli_query($con,$query);

			$ordinal=0;
				while ($resultc = mysqli_fetch_array($result)) {
					$idresidentes=$resultc['idresidentes'];
					$nombre=$resultc['nombre'];
					$nomfund=$resultc['nomfund'];
					$ordinal++;
			?>
			<tr>
				<td><?php echo $ordinal;?></td>
				<td><input type="checkbox" class="chk-box" value="<?php echo $idresidentes;?>" name="countries[]"/></td>
				<td><label><?php echo $nombre;?></label></td>
				<td><label><?php echo $nomfund;?></label></td>
			</tr>
			<?php
				}
			?>
			</tbody>
		</table>
		<br>	
		<button type="submit" class="btn-success" name="enviar">GENERAR</button>
		
		</form>
		
		</div>
				
	</body>
</html>
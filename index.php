<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
    if(isset($_GET['flag'])){
        $flag=1;
	}    
	else{
		$flag=0;
	}    
?>

	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="description" content="Fundación Jesús es mi roca"/>
		<meta name="keywords" content="Fundación Jesús es mi roca"/>
		<meta name="author" content="Softclass"/>
		<link rel="shortcut icon" href="images/favicon.ico">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">		
		<script src="js/jquery.js"></script> 
		<script src="js/bootstrap.min.js"></script>			<!-- boots -->		

	<title>Jesús es mi roca</title>

	<style>
		@import url(http://fonts.googleapis.com/css?family=Roboto:400);

		body {
		  background-color:#941524;
		  -webkit-font-smoothing: antialiased;
		  font: normal 14px Roboto,arial,sans-serif;
		}

		.container {
			padding-top: 5%;
			padding-bottom: 3%;
			padding-left: 7%;
			padding-right: 7%;
			position: relative;
		}

		.form-login {
			background-color: #ffffff;
			padding-top: 0%;
			padding-bottom: 3%;
			padding-left: 1%;
			padding-right: 1%;
			border-radius: 15px;
			border-width: 5px;
		}

		img { 
		width:40%;
		}

		label{
			color:white;
		}

		.form-control {
			border-radius: 10px;
		}

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

		.chat-input{
			width:50%;
			border-color:#9e8d6f;
			border-width: 3px;
		}

		.chat-input:focus{
			border-color:transparent;
		}

		h1{
			color:#941524;
		}
	</style>

	</head>

	<body>

		<section id="inicio">
			<center>
		
			<div class="container">
			
				<div class="row">
				
					<div class="col-lg-offset-2 col-md-8">
	
						<div class="form-login">

<?php
if($flag==1){
?>
    			<div class="alert alert-info" role="alert">
  					<b><i>Esta ingresando con un usuario o clave equivocados; verifique sus credenciales de acceso.</i></b>
				</div>
<?php
}
?>

							<img src="images/logob.jpg"></img>
							
							<a href="http://fundacionjesusesmiroca.org/negocio"><h1>
								Gestión fundación Jesús es mi roca</h1>
							</a><br>
							
							<form id="login" action = "login.php" method = "post" >
								<label for="userName">Código de usuario</label>
								<input type="text" id="userName" name="user" class="form-control input-sm chat-input" placeholder="Usuario"/><br>
								
								<label for="password">Contraseña</label>
								<input type="password" id="userPassword" name="pass" class="form-control input-sm chat-input" placeholder="Password"/><br>
								
								<div class="wrapper">
									<button type="submit" class="btn btn-default">Ingresar</button>          
								</div>
								
							</form>
							
						</div>
					
					</div>
					
				</div>
				
			</div>
			
			</center>
			
		</section>
		
	</body>
	
</html>
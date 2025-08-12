<?php
	$cedula=$_REQUEST['user'];

	$pass=MD5($_REQUEST['pass']);

	//$pass=$_REQUEST['pass'];

	include_once('bas/conn.php');

	mysqli_set_charset($con,"utf8");

	$query="select * from validacion join usuarios on validacion.idusuarios=usuarios.idusuarios 
	where usuarios.documento='$cedula' and validacion.password='$pass'";
	
	$result=mysqli_query($con,"$query");
	
	if(mysqli_num_rows($result)>0){
			while ($resultx = mysqli_fetch_array($result)) {
			$rol=$resultx['idroles'];
			$cedula=$resultx['documento'];
			$nombre=$resultx['nombres'];
			$apellido=$resultx['apellidos'];
			$clave=$resultx['idusuarios'];			
			}
		}	

	if($rol=='1'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["bda"]=true;

		header("Location:bda.php");
	}
	
	else if($rol=='2'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["sadmin"]=true;
	
		header("Location:automatico.php");
	}
	
	else if($rol=='3'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["admin"]=true;
	
		header("Location:automaticoa.php");	
	}
	
	else if($rol=='4'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["planta"]=true;
	
		header("Location:planta.php");	
	}
	
	else if($rol=='5'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["acud"]=true;

		header("Location:acudiente.php");	
	}

	else if($rol=='6'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["terg"]=true;

		header("Location:terapeuta.php");	
	}
	
	else if($rol=='7'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["tere"]=true;
		
		header("Location:practicante.php");	
	}
	
	else if($rol=='8'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["minuta"]=true;
		
		header("Location:minutae.php");	
	}
	
	else if($rol=='9'){
		session_start();
		$_SESSION["ok"]=true;
		$_SESSION["user"]=$cedula;
		$_SESSION["name"]=$nombre;
		$_SESSION["apellido"]=$apellido;
		$_SESSION["cons"]=$clave;
		$_SESSION["cajero"]=true;
		
		header("Location:cajero.php");	
	}
	
	else{
		header("Location:index.php?flag=1");
	}
	 
	mysqli_close($con);
?>
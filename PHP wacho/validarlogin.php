 <?php
 		session_start();
		include"modelo.php";
		include "autenticador.php";
		$nombre= $_POST['nombre'];
		$pass= $_POST['pass'];
		if(!empty($nombre) && !empty($pass)){
			$autenticador= new autenticador();
			if($autenticador->Login($nombre,$pass)){
				header("location:mimuro.php");
			}else { 
				header("location:index.php");

			}
		}	
		else{
			header("location:index.php");
		}
	
 ?>



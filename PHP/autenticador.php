<?php 
class autenticador{
	function Login($nombre,$pass){
		$link=conexion();
		$query= "select id, apellido, nombre, nombreusuario, email 
					 from usuarios u
					 where (nombreusuario ='$nombre') and (contrasenia='$pass')";
		$result=mysqli_query($link,$query);	
		$row=mysqli_fetch_array($result);
		try{
			if($row != null){

				$_SESSION['usuario']=$row;
				$_SESSION['exito']="Bienvenido!!:'.$nombre.'";
				return true;
			}else{
				throw new Exception('Usuario o contraseña incorrectos');
			}
		}	
		catch(Exception $e){
			$_SESSION["error"]=$e->getMessage();
		}
		include"desconexion.php";
	}
	function autenticado(){
			if(isset($_SESSION['usuario'])){
				return true;
			}else{
				throw new Exception('Usuario no autenticado');
			}
	}
	function autorizado	($id){
		$link=conexion();
		$idUser=$_SESSION['usuario']['id'];
				$query="select *
				from mensaje m 
				where m.id='$id' and m.usuarios_id='$idUser'";
		$result=mysqli_query($link,$query);
		$row=mysqli_num_rows($result);
		if($row!=0){
			return true;
		}else{
			throw new Exception('Usuario no autorizado');
		}		
	}
}


 ?>
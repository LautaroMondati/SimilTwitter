<?php
if(!session_id()){session_start();}
	include"modelo.php";
	$nombre= $_POST['nombre'];
		$apellido= $_POST['apellido'];
		$email= $_POST['email'];
		if(isset($_FILES['foto'])){
			$fotocontenido=addslashes(file_get_contents($_FILES["foto"]["tmp_name"]));
			$tipofoto=explode('/',$_FILES['foto']['type']);
		}else{
			$fotocontenido=NULL;
			$tipofoto=NULL;
		}
 	$User = array(	'nombre' =>$nombre,
					'apellido'=> $apellido,
					'email'=>$email,	
					'fotocontenido'=>$fotocontenido,
					'tipofoto'=>$tipofoto);
 	if(validarCambios($User)){
 		$resultado=guardarCambios($User);
 		$usuario=getUser($_SESSION['usuario']['id']);
 		$_SESSION['usuario']=mysqli_fetch_array($usuario);
 		$_SESSION['error']='Los cambios se realizaron correctamente';
 		header('location:editarPerfil.php');
 	}else{
 		header('location:editarPerfil.php');
 	}

 	function validarCambios($User){
 		$cant=0;

 		if(empty($User['nombre'])){
 			$_SESSION['nombre']="El nombre no puede estar vacio";
			$cant++;
		}
		if (strlen($User['nombre']) < 6){
			$_SESSION['nombre']="El nombre debe tener como minimo 6 caracteres";
			$cant++;
		}

		else if(!preg_match('/^[a-zA-Z]+$/',$_POST['nombre'])){//controla que sean caracteres alfabeticos
			$_SESSION['nombre']="Solo se permiten caracteres alfabeticos en el nombre";
			$cant++;
			

		}
		//APELLIDO
		if(empty($User['apellido'])){
			$_SESSION['apellido']="El apellido no puede estar vacio";
			$cant++;
		}else if (!preg_match('/^[a-zA-Z]+$/',$_POST['apellido'])){//controla que sean caracteres alfabeticos
			$_SESSION['apellido']="Solo se permiten caracteres alfabeticos en el apellido";
			$cant++;
		}else if(strlen($User['apellido'])<6){
			$_SESSION['apellido']="El apellido debe tener como minimo 6 caracteres";
			$cant++;
		}
				
		//EMAIL
		if(empty($User['email'])){
			$_SESSION['email']="El email no puede ser vacio";
			$cant++;
		}
		else if (!filter_var($User['email'], FILTER_VALIDATE_EMAIL)){ // controla que lo que se ingreso cumpla las condiciones para ser un mail
			$_SESSION['email']="Se debe ingresar un email valido";
			$cant++;
		}

		if(empty($User['fotocontenido'])){
			$_SESSION['foto']="La foto debe estar definida";
			$cant++;
		}
		if($cant > 0){
			return false;
			
		}
		else if($cant  == 0) {
			return true;
		} 
		


 	}


 ?>

<!--este archivo se encarga de validar si existe un nombre de usuario repetido .. si no existe  crea un usuario nuevo -->
<?php 
	session_start();
	include "modelo.php"; 
		$nombre= $_POST['nombre'];
		$apellido= $_POST['apellido'];
		$email= $_POST['email'];
		$usuario= $_POST['usuario'];
		$contraseña= $_POST['contraseña'];
		$re_contraseña= $_POST['re-contraseña'];
		if(!empty($_FILES['foto'])){
		$fotocontenido=addslashes(file_get_contents($_FILES["foto"]["tmp_name"]));
		$tipofoto=explode('/',$_FILES['foto']['type']);	
		}
		$User = array('nombre' =>$nombre,
							'apellido'=> $apellido,
							'email'=>$email,
							'usuario'=>$usuario,
							'contraseña'=>$contraseña,
							're_contraseña'=>$re_contraseña,
						'fotocontenido'=>$fotocontenido,
							'tipofoto'=>$tipofoto);
		if (validarDatosU($User)){
			if(NombreUsuario($usuario)==0){
				$resultado=Insertar($User);	
			}
		}		
		if(empty($resultado)){
				header('Location:registro.php');
				exit;
		}else{
				header('location:index.php');
				exit;
		}
 
	function validarDatosU($User){
		$cant = 0;
		 //NOMBRE
		if(empty($User['nombre'])){
			$cant++;
			$_SESSION['nombre']="Nombre vacio";
		}else if(!preg_match('/^[a-zA-Z]+$/',$_POST['nombre'])){//controla que sean caracteres alfabeticos
			$cant++;
			$_SESSION['nombre']="Solo se permiten caracteres alfabeticos en el nombre";
			
		}
		//APELLIDO
		if(empty($User['apellido'])){
			$cant++;
			$_SESSION['apellido']="Apellido no puede ser vacio";
		}else if (!preg_match('/^[a-zA-Z]+$/',$_POST['apellido'])){//controla que sean caracteres alfabeticos
			$cant++;
			$_SESSION['apellido']="Solo se permiten caracteres alfabeticos en el apellido";
		}			
		//EMAIL
		if(empty($User['email'])){
			$cant++;
			$_SESSION['email']="Email vacio";
		}
		else if (!filter_var($User['email'], FILTER_VALIDATE_EMAIL)){ // controla que lo que se ingreso cumpla las condiciones para ser un mail
			$cant++;
			$_SESSION['email']="Se debe ingresar un email valido";
		}		
		//USER NAME
		if ( strlen($User['usuario']) < 6 ){
			$cant++;
			$_SESSION['username']="El nombre de usuario deben ser por lo menos 6 caracteres";
		}
		else if (ctype_space($User['usuario'])){
			$cant++;
			$_SESSION['username']="El nombre de usuario no puede contener espacios";
			die('hola manola');
		}

		//CONTRASEÑA
		if (strlen($User['contraseña']) < 6 ){//controla la longitud de la contraseña
			$cant++;
			$_SESSION['pass']="La contraseña debe tener almenos 6 caracteres";
		}
		else if(ctype_space($User['contraseña'])){//controla que no tenga espacios
			$cant++;
			$_SESSION['pass']="La contraseña no puede contener espacios";
		
		}
		else if(!preg_match('/[A-Z]+/',$User['contraseña'])){//controla que la contraseña tenga almenos uns mayuscula
			$cant++;
			$_SESSION['pass']="La contraseña debe contener almenos una mayuscula";
		}
		else if(!preg_match('/\d/',$User['contraseña']) && preg_match('/[!-@]+/',$User['contraseña'] )){ //controla que la contraseña tenga almenos un simbolo o un numero
			$cant++;
			$_SESSION['pass']="La contraseña debe tener almenso un numero o un simbolo";
		}
		else if($User['contraseña'] != $User['re_contraseña']){
			$cant++;
			$_SESSION['repass']="las contraseñas no coinciden";
		}
				
	//FOTO
	if (empty($User['fotocontenido'])) {
			$cant++;
			$_SESSION['foto']="Debe haber una foto definida";
		}		
	if ($cant ==0){
		return true;
	}
	else{
		$valores = array('nombre' =>$User['nombre'] ,
									'apellido' =>$User['apellido'],
									 'email' =>$User['email'],
									  'username' =>$User['usuario'],
									  'pass' =>$User['contraseña'],
									  'foto' =>$User['fotocontenido'] );
		$_SESSION['valores']=$valores;
		return false;
	}

}				

 ?>
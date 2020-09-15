<?php 
if(!session_id()){session_start();}
include"modelo.php";
$passActual=$_POST['contraseña-vieja'];
$passNueva=$_POST['contraseña'];
$rePass=$_POST['re-contraseña'];
$miId=$_SESSION['usuario']['id'];
$resultado=validarpass($passActual);
$cantRes=mysqli_num_rows($resultado);
$valid=pass($passNueva);
if(($cantRes > 0) && ($passNueva==$rePass) && ($valid)){
	$newpass=cambiarpass($passNueva);
	var_dump($newpass);
	$_SESSION['error2']='Contraseña modificada correctamente';
	header('location:editarPerfil.php');
}else{
	
	$_SESSION['error2']='No se cambio la contraseña';
	header('location:editarPerfil.php');

}
function pass($passNueva){
		$cant=0;
		if (strlen($passNueva) < 6 ){//controla la longitud de la contraseña
			$cant++;
			
		}
		else if(ctype_space($passNueva)){
			
			$cant++;
		}
		else if(ctype_punct($passNueva)){//controla que no tenga espacios
		
			$cant++;
		}
		else if(!preg_match('/[A-Z]+/',$passNueva)){//controla que la contraseña tenga almenos uns mayuscula
			
			$cant++;
		}
		else if(!preg_match('/\d/',$passNueva) && preg_match('/[!-@]+/',$passNueva )){ //controla que la contraseña tenga almenos un simbolo o un numero
			$cant++;
			
		}
	if($cant > 0){
		
		return false;
	}
	else{
		
		return true;
	}
}	
?>
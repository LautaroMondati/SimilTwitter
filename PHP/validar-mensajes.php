<?php 
		if(!session_id()){session_start();}
		include"modelo.php";
		if(!empty($_POST['contenido'])){
			$texto=$_POST['contenido'];
		}else{
			$texto=NULL;
		}
		if(!empty(addslashes (file_get_contents($_FILES["foto"]["tmp_name"])))){
			$imagenContenido=addslashes (file_get_contents($_FILES["foto"]["tmp_name"]));
			$tipoimagen=explode('/', $_FILES['foto']['type']);
		}else{
			$imagenContenido=NULL;
			$tipoimagen=NULL;
		}	
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$fecha=date("Y-m-d H:i:s");
		$user=$_SESSION['usuario']['id'];
		$mensaje = array('texto' => $texto,'imagen_contenido'=> $imagenContenido, 'imagen_tipo'=>$tipoimagen, 'fechayhora'=>$fecha, 'usuarios_id'=>$user);
		$resultado=insertarMensaje($mensaje);
		if($resultado){
			if($_POST['redireccion']=="true"){
				header('location:mimuro.php');

			}	else{
				header('location:miperfil.php');
			}
		
		}
 ?>	
<?php 
	include"autenticador.php";
	 if(!session_id()){session_start();}
		include "modelo.php";
			$idMensaje=$_GET['id'];
			try{
				$autenticador=new autenticador();
				$autenticador->autorizado($idMensaje);
				borrarMensaje($idMensaje);
				if($_GET['pagina']==1){// boton me dice de que vista fue llamado el archivo
					header('location:mimuro.php');
				}else{
					header('location:miperfil.php');
				}
			}catch(Exception $e){
				if($_GET['pagina']==1){// boton me dice de que vista fue llamado el archivo
					header('location:mimuro.php');
				}else{
					header('location:miperfil.php');
				}
				
			}
		
 ?>
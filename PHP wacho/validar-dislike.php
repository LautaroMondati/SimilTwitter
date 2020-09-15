<?php 
	include"modelo.php";
	if(!session_id()){session_start();}
	$idUser=$_SESSION['usuario']['id'];
	$idMensaje=$_GET['id'];
	if(validarmg($idMensaje,$idUser)!=0){
		$eliminar=eliminarLike($idMensaje,$idUser);
	}	
	if($_GET['pagina']==1){

		header('location:mimuro.php');
		exit;
	}else{
		header('location:miperfil.php');
		exit;
	}	
 ?>
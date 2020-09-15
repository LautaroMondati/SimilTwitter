<?php
	include"modelo.php"; 
	if(!session_id()){session_start();}
	$miId=$_SESSION['usuario']['id'];
	$suId=$_GET['id'];
	$eliminar=eliminarUser($suId,$miId);
	$cadena=$_GET['cadena'];
	if($_GET['ok']== 0){
		header("location:listadoamigos.php?buscar=$cadena");

	}else if ($_GET['ok']==2){
		header("location:misamigos.php");
	}else{
		header("location:superfil.php?id=$suId");
	}

 ?>
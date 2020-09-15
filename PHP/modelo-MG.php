<?php 
	include"BD.php";
	//inserta un post en la base de datos
	function insertarMeGusta($idUser,$idMensaje){
		$link=conexion();
		$query="INSERT INTO  me_gusta (usuarios_id, mensaje_id) values ('$idUser', '$idMensaje')";
		$result=mysqli_query($link,$query);
		return $result;
		include"desconexion.php";
	}
	//verifica si el usuario que le llega como parametro ya le dio like al mensaje con id que llega con parametro
	function validarmg($idMensaje,$idUser){
		$link=conexion();
		$query="select id from me_gusta where mensaje_id='$idMensaje' and usuarios_id='$idUser'";
		$result=mysqli_query($link,$query);
		$row=mysqli_num_rows($result);
		return $row;
		include "desconexion";
	}
	function eliminarLike($idMensaje,$idUser){
		$link=conexion();
		$query="delete
				from me_gusta 
				where mensaje_id='$idMensaje' and usuarios_id='$idUser'";
		$result=mysqli_query($link,$query);
		return $result;
	}
 ?>
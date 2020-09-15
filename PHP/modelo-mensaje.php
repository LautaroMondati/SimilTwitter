<?php 
	include"BD.php";
	function insertarMensaje($mensaje){
		$link=conexion();
		$query="INSERT INTO mensaje (texto, imagen_contenido, imagen_tipo, usuarios_id, fechayhora) values ('" . $mensaje['texto'] . "', '" . $mensaje['imagen_contenido'] . "', '" . $mensaje['imagen_tipo'][1] . "', '" . $mensaje['usuarios_id'] . "', '" . $mensaje['fechayhora'] . "')";
		$result=mysqli_query($link,$query);
		return $result;
		include "desconexion";
	}

	//funcion para levantar todos los mensajes de la bd
	function mensajes($id){
	 if(!session_id()){session_start();}
		$link=conexion();
		$miId=$_SESSION['usuario']['id'];
		$query="select m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario, u.foto_contenido, u.foto_tipo, count(mg.mensaje_id) as cantmg
				from mensaje m
				inner join usuarios u on(m.usuarios_id= u.id)
				left join me_gusta mg on (mg.mensaje_id=m.id)
				where m.usuarios_id='$miId' or m.usuarios_id in (select s.usuarioseguido_id
										from siguiendo s 
										where s.usuarios_id='$id')
				group by m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario, u.foto_contenido, u.foto_tipo
				order by m.fechayhora desc";
		$result= mysqli_query($link,$query);
		return $result;
		include"desconexion.php";
	}
	//funcion para levantar los post de un usuario con id que llega como parametro
	function misMensajes($userId){
		$link=conexion();
		$query="select m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario, u.foto_contenido, u.foto_tipo, count(mg.mensaje_id) as cantmg
				from mensaje m
				inner join usuarios u on(m.usuarios_id=u.id)
				left join me_gusta mg on (mg.mensaje_id=m.id)
				where u.id='$userId'
				group by m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario, u.foto_contenido, u.foto_tipo
				order by m.fechayhora desc";
		$result= mysqli_query($link,$query);
		return $result;
		include"desconexion.php";
	}
	//borra el post con id que le llega como parametro
	function borrarMensaje($idMensaje){
		$link=conexion();
		$query1="delete from me_gusta where mensaje_id='$idMensaje'";
		$result1=mysqli_query($link,$query1);
		$query2="delete from mensaje where id='$idMensaje'";
		$result2=mysqli_query($link,$query2);
		include "desconexion.php";
	
	}
 ?>

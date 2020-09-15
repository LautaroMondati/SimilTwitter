	<?php 
	include "BD.php";
	if(!session_id()){session_start();}
	//funcion para obtener todos los post de un usuario en particular
	function getPost($usuarioId){
		$link=conexion();
		$query="select *
				from mensaje m
				where m.usuarios_id ='$usuarioID'";
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		return $row;
		include "desconexion.php";
	}
	//funcion para saber si el nombre de usuario ya esta en la base de datos
	function NombreUsuario($usuario){
		$link=conexion();
		$query="select nombreusuario
				from usuarios u
				where u.nombreusuario='$usuario'";
		$result=mysqli_query($link,$query);
		$rows=mysqli_num_rows($result);
		return $rows;
		include "desconexion.php";
	}
	//funcion para insertar un nuevo user en la bd
	function Insertar($User){
		$link=conexion();
		$query="INSERT INTO usuarios (apellido, nombre, email, nombreusuario, contrasenia, foto_contenido, foto_tipo) VALUES('" . $User['apellido'] . "', '" . $User['nombre'] . "', '" . $User['email'] . "', '" . $User['usuario'] . "', '" . $User['contraseña'] . "', '" . $User['fotocontenido'] . "', '" . $User['tipofoto'][1] . "')";
		$result = mysqli_query($link,$query);
		return $result;
		include"desconexion.php";
	}
	//obtiene un listado usuarios seguidos que tiene el usuario con id que llega como parametro
	function getAmigos($idUser){
		$link=conexion();
		$query="select u.id, u.nombre, u.apellido, u.nombreusuario, u.email
				from usuarios u 
				where u.id in (select usuarioseguido_id
								from siguiendo s 
								where s.usuarios_id='$idUser')";
		$result=mysqli_query($link,$query);
		return $result;



	}
	//busca un usuario de la BD que corresponda al string cadena
	function buscarUsers($cadena){
		$miId=$_SESSION['usuario']['id'];
		$link=conexion();
		$query="select id, nombre, apellido, email,nombreusuario
				from usuarios
				where id<>'$miId' and ( nombreusuario like '%{$cadena}%'or nombre like'%{$cadena}%'or apellido like '%{$cadena}%')";
		$result=mysqli_query($link,$query);
		return $result;

	}
	//elimina un usuario de la BD
	function eliminarUser($suId,$miId){
		$link=conexion();
		$query="delete
				from siguiendo
				where usuarios_id='$miId' and usuarioseguido_id='$suId'";
		$result=mysqli_query($link,$query);
		return $result;

	}
	//devuelve toda la informacion del usuario que llega como parametro
	function getPerfilAmigo($id){
		$miId=$_SESSION['usuario']['id'];
		$link=conexion();
		$query="select *
				from usuarios
				where id='$id'";
		$result=mysqli_query($link,$query);		
		return $result;
	}
	//devuelve todos los mensajes del usuario que llega como parametro
	function mensajesPerfilAmigo($id){
		$link=conexion();
		$query="select m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora,u.nombreusuario, count(mg.mensaje_id) 	as cantmg
				from mensaje m 
				inner join usuarios u on  (m.usuarios_id=u.id)
				left join me_gusta mg on (mg.mensaje_id=m.id)
				where u.id='$id'
				group by  m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario
				order by m.fechayhora desc";
		$result=mysqli_query($link,$query);
		return $result;
	}
	//trae toda la informacion de un usuario que no es el logueado para mostrar en su perfil
	function follow($id){
		$myID= $_SESSION['usuario']['id'];
		$link=conexion();
		$query="select *
				from siguiendo s
				where (s.usuarios_id='$myID' and s.usuarioseguido_id='$id')";
		$result=mysqli_query($link, $query);
		return $result;
	}
	//agrega una tupla en la tabla siguiendo dependiendo los id que llegan como parametro
	function Seguidor($suId,$miId){
		$link=conexion();
		$query="insert into siguiendo (usuarios_id, usuarioseguido_id) values ('$miId', '$suId')";
		$result=mysqli_query($link,$query);
		return $result;

	}
	//inserta un mensaje en la BD
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
	//agrega una tupla a la tabla megusta dependiendo los id que llegan como parametro
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
	//elimina una tupla de la tabla megusta de la BD dependiendo el id del mensaje y del id del user

	function eliminarLike($idMensaje,$idUser){
		$link=conexion();
		$query="delete
				from me_gusta 
				where mensaje_id='$idMensaje' and usuarios_id='$idUser'";
		$result=mysqli_query($link,$query);
		return $result;
	}
	//devuelve los datos seleccionados del usuario con id que llega como parametro
	function getUser($id){
		$link=conexion();
		$query="select id, apellido, nombre, nombreusuario, email
				from usuarios 
				where id='$id'";
		$result=mysqli_query($link,$query);
		return $result;
	}
	//actualiza los datos del usuario que llega como parametro
	function guardarCambios($User){
		$link=conexion();
		$miId=$_SESSION['usuario']['id'];
		$query="update usuarios set apellido='" .$User['apellido']. "', nombre ='" .$User['nombre']. "', email ='" .$User['email']. "'"; 
		if(isset($User['fotocontenido']) && ($User['fotocontenido']!=NULL)){
			$query= $query . ",foto_contenido='" .$User['fotocontenido']. "', foto_tipo='" .$User['tipofoto'][1]. "'";

		}
		$query= $query . "where id='$miId'";
		$result=mysqli_query($link,$query);
		return $result;
	}
	//valida que la contraseña que ingreso sea igual a la que esta en la BD
	function validarpass($pass){
		$miId=$_SESSION['usuario']['id'];
		$link=conexion();
		$query="select id
				from usuarios
				where id='$miId' and contrasenia='$pass'";
		$result=mysqli_query($link,$query);
		return $result;
	}
	//cambia la contraseña de la BD por la que llega como parametro
	function cambiarpass($pass){
		$miId=$_SESSION['usuario']['id'];
		$link=conexion();
		$query="update usuarios set contrasenia='$pass' where id='$miId'";
		$result=mysqli_query($link,$query);
		return $result;
	}
	//verifica si el usuario logueado dio like en una publicacion
	function like($id){
		$miId=$_SESSION['usuario']['id'];
		$link=conexion();
		$query="select m.usuarios_id
				from mensaje m 
				where m.id='$id' and $miId in(select mg.usuarios_id
											from me_gusta mg 
											where mg.mensaje_id=m.id )";
		$result=mysqli_query($link,$query);
		return $result;
	}
 ?>
 
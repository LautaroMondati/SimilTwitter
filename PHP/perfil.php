<!DOCTYPE html>
<html>
<head>
	<title> Mi Perfil</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link rel="stylesheet" type="text/css" href="popup.css">
	<script type="text/javascript" src="popup.js"></script>
</head>
<body>
	
	<div class="navigation">
		 	<input type="checkbox" name="">
		 	<span></span>
		 	<label>Menu: </label>
		 	<span></span>
		 	<ul class="menu">
		 		<li><a href="mimuro.php">Mi Perfil</a>
		 		<li><a href="#">Inicio</a>
		 		<li><a href="index.php">Cerrar sesion</a>
			</ul>
	</div>
	<aside class="conteiner-miperfil">
			<p> Mi Perfil</p>
			<img  src="perfil-vacio.jpg">
			<div class="datos-perfil">		
				<ul>
					<li type="disc"><p>Nombre:</p></li>
					<li type="disc"><p>Apellido:</p></li>
					<li type="disc"><p>Email:</p></li>
					<li><button class="Boton" onclick=" location.href='editarPerfil.php'">Modificar Perfil</button></li>
					<li><button class="Boton">Amigos</button></li>
				</ul>								
			</div>
	</aside>
	
</body>
</html>
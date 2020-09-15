<?php if(!session_id()){session_start();} ?>
	<aside class="conteiner-miperfil">
			<p> Mi Perfil</p>
			<div class="navigation">
		 	<input type="checkbox" name="">
		 	<span><?php  ?></span>
		 	<label>Menu: </label>
		 	<span></span>
		 	<ul class="menu">
		 		<li><a href="miperfil.php">Mi Perfil</a>
		 		<li><a href="mimuro.php">Mi Muro</a>
		 		<li><a href="cerrarSesion.php">Cerrar sesion</a>
			</ul>
	</div>
			<img class="fotoperfil" src="fotos.php?id=<?php echo $_SESSION['usuario']['id']; ?>">
			<div class="datos-perfil">	
			<legend><?php echo $_SESSION['usuario']['nombreusuario'] ?></legend>	
				<ul>
					<li type="disc"><p>Nombre:<?php echo $_SESSION['usuario']['nombre'] ?></p></li>
					<li type="disc"><p>Apellido:<?php echo $_SESSION['usuario']['apellido'] ?></p></li>
					<li type="disc"><p><?php echo $_SESSION['usuario']['email'] ?></p></li>
					<li><button class="Boton" onclick=" location.href='editarPerfil.php'">Modificar Perfil</button></li>
					<li><button class="Boton" onclick=" location.href='misamigos.php'">Amigos</button></li>
				</ul>								
			</div>
	</aside>

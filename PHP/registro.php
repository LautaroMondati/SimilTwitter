<!DOCTYPE html>
<html>
<head>
	<title>The Wall	</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link rel="stylesheet" type="text/css" href="popup.css">
	<script type="text/javascript"src="popup.js"></script>
	<script type="text/javascript" src="validacion-formulario-registrarse.js"></script> 
</head>
<body>
	<?php include"header.php" ?>
		<div class="signup-form">
			<form name="registro" action="validarregistro.php" enctype="multipart/form-data" method="POST" onsubmit="return validarformulario();">
				<legend><h1>Registrar Usuario</h1></legend>
				<hr>
				<?php
	 			if(!session_id()){session_start();} ?>
				<div class="contenedor" id="tabla">
				
					<input type="text"  id="nombre" name="nombre" placeholder="Nombre" value="<?php if(isset($_SESSION['valores']['nombre'])){
						echo $_SESSION['valores']['nombre'];
						unset($_SESSION['valores']['nombre']);
					} ?>">
					<div class="error" id="nameid">
					</div>
					<?php if(!empty($_SESSION['nombre'])){
					echo $_SESSION['nombre'];
					unset($_SESSION['nombre']);
					} ?>
					<input type="text" id="apellido" name="apellido" placeholder="Apellido" value="<?php if(isset($_SESSION['valores']['apellido'])){
						echo $_SESSION['valores']['apellido'];
						unset($_SESSION['valores']['apellido']);
					} ?>">
					<div  class="error" id="lastnameid">
					</div>
					<?php if(!empty($_SESSION['apellido'])){
				echo $_SESSION['apellido'];
				unset($_SESSION['apellido']);
				} ?>
					<input type="text" id="email" name="email" placeholder="Email" value="<?php if(isset($_SESSION['valores']['email'])){
						echo $_SESSION['valores']['email'];
						unset($_SESSION['valores']['email']);
					} ?>">
					<div class="error" id="emaildirid">
					</div>
					<?php if(!empty($_SESSION['email'])){
				echo $_SESSION['email'];
				unset($_SESSION['email']);
				} ?>
					<input type="text" id="usuario" name="usuario" placeholder="Usuario"value="<?php if(isset($_SESSION['valores']['username'])){
						echo $_SESSION['valores']['username'];
						unset($_SESSION['valores']['username']);
					} ?>">
					<div class="error" id="usernameid">
					</div>
					<?php if(!empty($_SESSION['username'])){
				echo $_SESSION['username'];
				unset($_SESSION['username']);
				} ?>
					<input type="password" id="contraseña" name="contraseña" placeholder="Contraseña"value="<?php if(isset($_SESSION['valores']['pass'])){
						echo $_SESSION['valores']['pass'];
						unset($_SESSION['valores']['pass']);
					} ?>">
					<div class="error" id="passid">
					</div>
					<?php if(!empty($_SESSION['pass'])){
				echo $_SESSION['pass'];
				unset($_SESSION['pass']);
				} ?>
					<input type="password" id="re-contraseña" name="re-contraseña" placeholder="Repita Contraseña" >
					<div class="error" id="re-passid">
					</div>
					<?php if(!empty($_SESSION['repass'])){
				echo $_SESSION['repass'];
				unset($_SESSION['repass']);
				} ?>
					<label for=Foto>Foto de Perfil</label>
					<input type="file" id="fotoperfil" name="foto" placeholder="Foto de Perfil" >
					<div class="error" id="foto">
					</div>
					<?php if(!empty($_SESSION['foto'])){
				echo $_SESSION['foto'];
				unset($_SESSION['foto']);
				} ?>
				
					<input type="submit" name="registrarse" value="Registrarse"> 
					<a href="index.php">Ya Tenes Cuenta ?</a>
				</div>
			</form>
		</div>
		<?php include "footer.php" ?>
</body>
</html>
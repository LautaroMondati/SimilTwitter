<?php session_start();?>
<html>
<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link rel="stylesheet" type="text/css" href="popup.css">
	<script type="text/javascript" src="popup.js"></script> 
	<script type="text/javascript"src="validar-inicion-sesion.js"></script>
	<title>THE WALL: una nueva red social</title>
</head>
<body class="Body">
	<?php include "header.php"; ?>
	
		<form name="InicioSesión" action="validarlogin.php" method="POST" onsubmit="return validarInicioSesion() ">
		<div class="Inicio">
		<legend>Inicia Sesion</legend>
	<div class="conteiner-inicio-sesion">	
	<div >	
	<?php if(!empty($_SESSION['error'])){
			echo $_SESSION['error'];
			unset($_SESSION['error']);}?>
	</div>
		<input type="text"  id="nombre" name="nombre" placeholder="Nombre de Usuario" ><br>
		<div class="error" id="nameid">
					</div>
		<input type="password" id="pass" name="pass" placeholder="Contraseña" ><br>
		<div class="error" id="passwordid">
					</div>
		<input type="submit" class="Boton" value="Iniciar Sesión">
		</div>
		</form>
	</div>
<div class= "Registro"><p class="Campos">&iquest;No tienes una cuenta?</p>
	
<button onclick="location.href='registro.php'" class="Boton">Regístrate!<i class="fas fa-heart"></i></button></div>
<?php include "footer.php";?>
</body>
</html>
	  
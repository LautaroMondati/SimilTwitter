
function validarformulario(){
	var nombre = document.getElementById("nombre").value,
		apellido = document.getElementById("apellido").value,
		email = document.getElementById("email").value,
		usuario = document.getElementById("usuario").value,
		pass= document.getElementById("contraseña").value,
		repass = document.getElementById("re-contraseña").value,
		foto = document.getElementById("fotoperfil").value,
		cant = 0;
		 if(!nombre){
			var nameid = document.getElementById("nameid");
			nameid.innerHTML="Debe completar el campo";
			document.getElementById("nombre").style.border= "red 2px solid";
			cant++;
			//return false;
		}
		else if (/^\s+$/.test(nombre)){
			var nameid = document.getElementById("nameid");
			nameid.innerHTML="El nombre no puede contener espacios";
			document.getElementById("nombre").style.border= "red 2px solid";
			cant++;
			//return false;
		}
		else if (!/^[a-zA-Z]+$/.test(nombre)){
			//document.write(!/^[a-zA-Z]+$/.test(nombre));
			//return false;
			var nameid = document.getElementById("nameid");
			nameid.innerHTML="Solamente se permiten caracteres alfabeticos";
			document.getElementById("nombre").style.border= "red 2px solid";
			cant++;
			//return false;
		}
	else{
			var nameid = document.getElementById("nameid");
			nameid.innerHTML="";
		document.getElementById("nombre").style.border= "#00ff00 2px solid";
	}
	//aca termina la validacion del nombre y empieza la del apellido
	if (!apellido){
			var lastnameid = document.getElementById("lastnameid");
			lastnameid.innerHTML="Debe completar el campo";
			document.getElementById("apellido").style.border="red 2px solid";
			cant++;
			//return false;
	}
		else if(/^\s+$/.test(apellido)){
			var lastnameid = document.getElementById("lastnameid");
			lastnameid.innerHTML="El campo no puede contener espacios";
			document.getElementById("apellido").style.border="red 2px solid";
			cant++;
			//return false;
		}
		else if (!/^[a-zA-Z]+$/.test(apellido)){
			var lastnameid = document.getElementById("lastnameid");
			lastnameid.innerHTML="Solo se permiten caracteres alfabeticos";
			document.getElementById("apellido").style.border= "red 2px solid";
			cant++;
		}
	else{
		var lastnameid = document.getElementById("lastnameid");
		lastnameid.innerHTML="";
		document.getElementById("apellido").style.border="#00ff00 2px solid";
	}
	//aca termina la validacion de apellido y empieza la del email
		if (!email){
			var emaildirid = document.getElementById("emaildirid");
			emaildirid.innerHTML="Debe completar el campo";
			document.getElementById("email").style.border="red 2px solid";
			cant++;
		}
	else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)){
		var emaildirid = document.getElementById("emaildirid");
			emaildirid.innerHTML="Debe ingresarse un mail";
			document.getElementById("email").style.border="red 2px solid";
			cant++;
	}
		else{
			var emaildirid = document.getElementById("emaildirid");
			emaildirid.innerHTML="";
			document.getElementById("email").style.border="#00ff00 2px solid";
	}
	//aca termina la validacion del email y empieza la de nombre de usuario
	if ( usuario.length < 6 ){
		var usernameid = document.getElementById("usernameid");
		usernameid.innerHTML="El nombre de usuario debe poseer almenosseis caracteres";
		document.getElementById("usuario").style.border="red 2px solid";
		cant++;
	}
	else{
		var usernameid = document.getElementById("usernameid");
		usernameid.innerHTML="";
		document.getElementById("usuario").style.border="#00ff00 2px solid";
	}
	//aca termina la validación de nombre de usuario y comienza la de contraseña
	if (pass.length < 6){
		var passid = document.getElementById("passid");
		passid.innerHTML="La contraseña debe poseer almenos seis caracteres";
		document.getElementById("contraseña").style.border="red 2px solid";
		cant++;
	}
	else if (/^\s+$/.test(pass)){
			var passid = document.getElementById("passid");
			passid.innerHTML="La contraseña no puede contener espacios";
			document.getElementById("contraseña").style.border= "red 2px solid";
			cant++;
	}
	else if(!/[A-Z]+/.test(pass)){
			var passid = document.getElementById("passid");
			passid.innerHTML="La contraseña debe poseer al menos una mayuscula";
			document.getElementById("contraseña").style.border="red 2px solid";
			cant++;	
	}
	else if( !/\d/.test(pass) && !/[!-@]+/.test(pass)){
			var passid = document.getElementById("passid");
			passid.innerHTML="La contraseña debe poseer al menos un símbolo o un número.";
			document.getElementById("contraseña").style.border="red 2px solid";
			cant++;
	}
	else if(pass != repass){
		var passid = document.getElementById("passid");
		passid.innerHTML="Las contraseñas deben coincidir";
		document.getElementById("contraseña").style.border="red 2px solid";
		document.getElementById("re-contraseña").style.border="red 2px solid";
		cant++;
	}
	else{
		var passid = document.getElementById("passid");
		passid.innerHTML="";
		var repassid = document.getElementById("re-passid");
		repassid.innerHTML="";
		document.getElementById("contraseña").style.border="#00f000 2px solid";
		document.getElementById("re-contraseña").style.border="#00f000 2px solid";
	} 
	if(!repass){
		var repassid = document.getElementById("re-passid");
		repassid.innerHTML="Debe completar el campo.";
		document.getElementById("re-contraseña").style.border="red 2px solid";
		cant++;
	}
	//aca termina la validacion de la contraseña y empieza la validacion de la foto de perfil
	if (!foto) {
		var fotoid = document.getElementById("foto");
		fotoid.innerHTML="Se debe seleccionar una foto de perfil.";
		document.getElementById("fotoperfil").style.border="red 2px solid";
		cant++;
	}
	else{
		var fotoid = document.getElementById("foto");
		fotoid.innerHTML="";
		document.getElementById("fotoperfil").style.border="#00f000 2px solid";
	}
	if(cant > 0){
		
		return false;
	}
	else if(cant  == 0) {
		return true;
	}


}
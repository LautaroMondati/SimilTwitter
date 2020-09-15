function validarInicioSesion() {
	var nombre = document.getElementById("nombre").value,
		password = document.getElementById("pass").value,
		cant =0;
		if(!nombre){
			var nameid = document.getElementById("nameid");
			nameid.innerHTML="Debe completar el campo";
			document.getElementById("nombre").style.border= "red 2px solid";
			cant++;
		}
			else{
				var nameid = document.getElementById("nameid");
				nameid.innerHTML="";
			
			}
		if (!password){
			var passwordid = document.getElementById("passwordid");
			passwordid.innerHTML="Debe completar el campo";
			document.getElementById("pass").style.border="red 2px solid";
			cant++;
		}
		else{
		var passwordid = document.getElementById("passwordid");
		passwordid.innerHTML="";
		
		}
	if(cant > 0){
		return false;
	}
	 
}
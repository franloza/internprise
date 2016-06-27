var fieldsEstudiante = { 
	email: false,
	password: false,
	dni: false,
	nombre: false,
	apellidos: false,
	grado: false,
	universidad: false,
	nacionalidad: false,
	direccion: false,
	fecha: false,
	cp: false,
	ciudad: false,
	provincia: false,
	pais: false
};

var fieldsAdmin = { 
	email: false,
	password: false,
	nombre: false,
	apellidos: false,
	universidad: false,
	direccion: false,
	cp: false,
	localidad: false,
	provincia: false,
	pais: false
};

var fieldsEmpresa = { 
	email: false,
	password: false,
	cif: false,
	razon: false,
	direccion: false,
	cp: false,
	localidad: false,
	provincia: false,
	pais: false
};

function resetFields() {
	for (var i in fieldsEstudiante)
		fieldsEstudiante[i] = false;
	for (var i in fieldsEmpresa)
		fieldsEmpresa[i] = false;
	for (var i in fieldsAdmin)
		fieldsAdmin[i] = false;
}

function validate(field, item) {
	switch (field) {
		case 'email':
			validateEmail(item);
			break;

		case 'password':
			fieldsAdmin["password"] = fieldsEmpresa["password"] = fieldsEstudiante["password"] = validatePassword(item);
			break;

		case 'cif':
			fieldsEmpresa["cif"] = validateCif(item);
			break;

		case 'razon':
			fieldsEmpresa["razon"] = validateRazon(item); 	
			break;

		case 'dni':
			fieldsEstudiante["dni"] = validateDni(item);
			break;
		
		case 'nombre':
			fieldsAdmin["nombre"] = fieldsEstudiante["nombre"] = validateName(item);
			break;

		case 'apellidos':
			fieldsAdmin["apellidos"] = fieldsEstudiante["apellidos"] = validateSurname(item);
			break;

		case 'grado':
			fieldsEstudiante["grado"] = validateGrado(item);
			break;

		case 'gradocomplete':
			validateGradoAutocomplete(item);
			break;

		case 'gradosFill':
			getAllGrados();
			break;

		case 'universidad':
			fieldsAdmin["universidad"] = fieldsEstudiante["universidad"] = validateUniversidad(item);
			break;
		
		case 'unicomplete':
			validateUniversidadAutocomplete(item);
			break;

		case 'nacionalidad':
			fieldsEstudiante["nacionalidad"] = validateNacionalidad(item);
			break;

		case 'direccion':
			fieldsAdmin["direccion"] = fieldsEmpresa["direccion"] = fieldsEstudiante["direccion"] = validateDireccion(item);
			break;

		case 'fecha':
			fieldsEstudiante["fecha"] = validateFecha(item);
			break;

		case 'cp':
			fieldsAdmin["cp"] = fieldsEmpresa["cp"] = fieldsEstudiante["cp"] = validateCp(item);
			break;

		case 'localidad':
			fieldsAdmin["localidad"] = fieldsEmpresa["localidad"] = validateLocalidad(item); 	
			break;

		case 'ciudad':
			fieldsEstudiante["ciudad"] = validateCiudad(item);
			break;

		case 'provincia':
			fieldsAdmin["provincia"] = fieldsEmpresa["provincia"] = fieldsEstudiante["provincia"] = validateProvincia(item);
			break;

		case 'pais':
			fieldsAdmin["pais"] = fieldsEmpresa["pais"] = fieldsEstudiante["pais"] = validatePais(item);
			break;

		case 'buscador':
			validateBuscador(item);
			break;
	}
}

// Cambia el color del borde de los inputs
function inputStyle(item, msg, isOk) {
	if (!isOk) {
		item.value = "";
		item.style = "border: 1px solid red";
		item.placeholder = msg;
	} else 
		item.style = "border: 1px solid green";
}

function validateEmail(item) {
	var email = item.value;
	var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;

	if (email.length == 0) 
		inputStyle(item, "El campo email es obligatorio", false);
	else if (!re.test(email)) 
		inputStyle(item, "El email introducido es incorrecto", false);
	else  {
		$.ajax(
		{
			url : 'ajaxRequest.php',
			type: "GET",
			data : {datamail: email}
		})
		.done(function(data) {
			var res = JSON.parse(data).result;
			if (!res) 
				inputStyle(item, "El email introducido ya esta en uso", false);
			else {
				inputStyle(item, null, true);
				fieldsAdmin["email"] = fieldsEmpresa["email"] = fieldsEstudiante["email"] = true;
			}
		})
	}
}

function validatePassword(item) {
	var ok = false;

	if (item.value.length == 0)
		inputStyle(item, "El campo password es obligatorio", false);
	else if (item.value.length < 8) 
		inputStyle(item, "Ha de tener 8 caracteres minimo", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}
	
	return ok;
}

function validateDni(item) {
	var ok = false;

	if (item.value.length == 0)
		inputStyle(item, "El campo DNI es obligatorio", false);
	else {
		var expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

		if (expresion_regular_dni.test(item.value)) {
			var numero = item.value.substr(0, 8);
			var letr = item.value.substr(8, 1);
			numero = numero % 23;
			var letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
			letra = letra.substring(numero, numero+1);

			if (letra != letr.toUpperCase()) 
				inputStyle(item, "DNI erroneo, la letra no se corresponde", false);
			else {
				inputStyle(item, null, true);
				ok = true;
			}
		} else
			inputStyle(item, "DNI erroneo, formato no valido", false);
	}

	return ok;
}

function validateRazon(item) {
	var ok = false;

	if (item.value.length == 0)
		inputStyle(item, "El campo razon social es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateCif(item) {
	var ok = false;

	if (item.value.length == 0)
		inputStyle(item, "El campo cif es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateName(item) {
	var ok = false;

	if (item.value.length == 0)
		inputStyle(item, "El campo nombre es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateSurname(item) {
	var ok = false;

	if (item.value.length == 0)
		inputStyle(item, "El campo apellidos es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateGradoAutocomplete(item) {
	var grado = item.value;

	$.ajax({
		url : 'ajaxRequest.php',
		type: "GET",
		dataType: "json",
		data: {datagrado: grado}
	}) .done (function(data) {
		var options = '';
		for (var i = 0; i < data.length; i++)
			options += '<option value="' + data[i] + '" />';
		document.getElementById('listgrado').innerHTML = options;
	});
}

function getAllGrados(){
	$.ajax({
		url : 'ajaxRequest.php',
		type: "GET",
		dataType: "json",
		data: {datagrado: 'G'}
	}) .done (function(data) {
		var options = '';
		for (var i = 0; i < data.length; i++)
			options += '<option> ' + data[i] + ' </option>';
		//document.getElementById('listgrados')[0].innerHTML = options;
		$("#list-grados:last-child").html(options);
	});
}

function validateGrado(item) {
	var grado = item.value;
	var ok = false;

	if (grado.length == 0)
		inputStyle(item, "El campo grado es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateUniversidadAutocomplete(item) {
	var uni = item.value;

	$.ajax({
		url : 'ajaxRequest.php',
		type: "GET",
		dataType: "json",
		data: {datauni: uni}
	}) .done (function(data) {
		var options = '';
		for (var i = 0; i < data.length; i++)
			options += '<option value="' + data[i] + '" />';
		document.getElementById('listuni').innerHTML = options;
	});
}

function validateBuscador(item) {
	var buscador = item.value;

	$.ajax({
		url : 'ajaxRequest.php',
		type: "GET",
		dataType: "json",
		data: {databuscador: buscador}
	}) .done (function(data) {
		var options = '';
		for (var i = 0; i < data.length; i++)
			options += '<option value="' + data[i][1] + '" />';
		document.getElementById('list666').innerHTML = options;
	});
}

function validateUniversidad(item) {
	var uni = item.value;
	var ok = false;

	if (uni.length == 0)
		inputStyle(item, "El campo universidad es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateNacionalidad(item) {
	var nac = item.value;
	var ok = false;

	if (nac.length == 0)
		inputStyle(item, "El campo nacionalidad es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateLocalidad(item) {
	var loc = item.value;
	var ok = false;

	if (loc.length == 0)
		inputStyle(item, "El campo localidad es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateDireccion(item) {
	var dir = item.value;
	var ok = false;

	if (dir.length == 0)
		inputStyle(item, "El campo direccion es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateFecha(item) {
	var fecha = item.value;
	var ok = false;

	if (fecha.length == 0)
		inputStyle(item, "El campo fecha es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateCp(item) {
	var cp = item.value;
	var ok = false;

	if (cp.length == 0)
		inputStyle(item, "El campo Codigo postal es obligatorio", false);
	else {
		var expresion_regular_cp = /^\d{5}$/;

		if (expresion_regular_cp.test(cp)) {
			inputStyle(item, null, true);
			ok = true;
		}
		else
			inputStyle(item, "El campo Codigo postal es erroneo", false);
	}

	return ok;
}

function validateCiudad(item) {
	var ciu = item.value;
	var ok = false;

	if (ciu.length == 0)
		inputStyle(item, "El campo ciudad es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateProvincia(item) {
	var prov = item.value;
	var ok = false;

	if (prov.length == 0)
		inputStyle(item, "El campo provincia es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validatePais(item) {
	var pais = item.value;
	var ok = false;

	if (pais.length == 0)
		inputStyle(item, "El campo pais es obligatorio", false);
	else {
		inputStyle(item, null, true);
		ok = true;
	}

	return ok;
}

function validateform(item) {
	var tipo = item.id; 
	var ok = true;

	switch(tipo) {
		case 'formRegister_estudiante':
			for (var i in fieldsEstudiante) {
				if (fieldsEstudiante[i] == false)
					ok = false;
			}
			break;
		
		case 'formRegister_admin':
			for (var i in fieldsAdmin) {
				if (fieldsAdmin[i] == false)
					ok = false;
			}
			break;

		case 'formRegister_empresa':
			for (var i in fieldsEmpresa) {
				if (fieldsEmpresa[i] == false)
					ok = false;
			}
			break;
	}

	return ok;
}

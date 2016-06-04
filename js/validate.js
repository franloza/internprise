function validate(field, item) {
	switch (field) {
		case 'email':
			validateEmail(item);
			break;

		case 'password':
			validatePassword(item);
			break;

		case 'dni':
			validateDni(item);
			break;
		
		case 'nombre':
			validateName(item);
			break;

		case 'apellidos':
			validateSurname(item);
			break;

		case 'grado':
			validateGrado(item);
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
			var ok = JSON.parse(data).result;
			if (!ok) 
				inputStyle(item, "El email introducido ya esta en uso", false);
			else
				inputStyle(item, null, true);
		})
	}
}

function validatePassword(item) {
	if (item.value.length == 0)
		inputStyle(item, "El campo password es obligatorio", false);
	else if (item.value.length < 8) 
		inputStyle(item, "Ha de tener 8 caracteres minimo", false);
	else
		inputStyle(item, null, true);
}

function validateDni(item) {
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
			else
				inputStyle(item, null, true);
		} else
			inputStyle(item, "DNI erroneo, formato no valido", false);
	}
}

function validateName(item) {
	if (item.value.length == 0)
		inputStyle(item, "El campo nombre es obligatorio", false);
	else
		inputStyle(item, null, true);
}

function validateSurname(item) {
	if (item.value.length == 0)
		inputStyle(item, "El campo apellidos es obligatorio", false);
	else
		inputStyle(item, null, true);
}

function validateGrado(item) {
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
		document.getElementById('list').innerHTML = options;
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
			options += '<option value="' + data[i] + '" />';
		document.getElementById('list666').innerHTML = options;
	});
}
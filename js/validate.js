function validateEmail(email) {
	var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
	return re.test(email);
}

function inputStyle(item, msg, isOk) {
	item.value = "";

	if (isOk) {
		item.style = "border: 1px solid red";
		item.placeholder = msg;
	} else 
		item.style = "border: 1px solid black";
}

function validate(field, item) {

	switch (field) 
	{
		case 'email':
			if (item.value.length == 0)
				inputStyle(item, "El campo email es obligatorio", false);
			else if (!validateEmail(item.value)) 
				inputStyle(item, "El email introducido es incorrecto", false);
			else  
			{
				$.ajax(
				{
					url : 'ajaxRequest.php',
				    type: "GET",
					data : {email: item.value}

				})
				.done(function(data) {
					alert(data.result);
					if (!data.result) 
						inputStyle(item, "El email introducido ya esta en uso", false);
				})

				inputStyle(item, null, true);
			}
			break;

		case 'password':
			if (item.value.length < 8) 
				inputStyle(item, "Ha de tener 8 caracteres minimo", false);
			else
				inputStyle(item, null, true);
			break;


	}
}

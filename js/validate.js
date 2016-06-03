function validate(field, element) {
	if (element.value.length == 0) {
		element.style = "border: 1px solid red";
	} else
		element.style = "border: 1px solid black";

	switch (field) {
		case 'email':
			var expr = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';
			if (!expr.test(element.value)) {
				element.value = "";
				element.style = "border: 1px solid red";
				element.placeholder = "El email introducido es incorrecto";
			} else
				element.style = "border: 1px solid black";
			break;
		case 'password':
			if (element.value.length < 8) {
				element.value = "";
				element.style = "border: 1px solid red";
				element.placeholder = "Ha de tener 8 caracteres minimo";
			} else
				element.style = "border: 1px solid black";
			break;
	}
}

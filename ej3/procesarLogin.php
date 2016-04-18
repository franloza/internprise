<?php

$usuario = $_POST["usuario"];
$contraseña = $_POST["contraseña"];

if ($usuario =="admin" && $contraseña ="adminpass"){
	$_SESSION['nombre'] = "Admin";
	$_SESSION['login'] = true;
	$_SESSION['esAdmin'] = true;
}elseif ($usuario =="user" && $contraseña ="userpass") {
	$_SESSION['nombre'] = "Juan";
	$_SESSION['login'] = true;
	$_SESSION['esAdmin'] = false;
}else{
	$_SESSION['nombre'] = "desconocido";
	$_SESSION['login'] = false;
	$_SESSION['esAdmin'] = false;
}






?>
<?php

namespace es\ucm\aw\internprise;

class FormularioCrearOferta extends Form
{
    public function __construct() {
        $opciones = array(
          "ajax" => true,
            "action" => "dashboard.php",
            "class" => null,
            "enctype" => null
        );
        parent::__construct('formCrearOferta', $opciones);
    }

    protected function generaCamposFormulario ($datos) {
        $username = 'user@example.org';
        $password = '12345';
        if ($datos) {
            $username = isset($datos['username']) ? $datos['username'] : $username;
            $password = isset($datos['password']) ? $datos['password'] : $password;
        }

        /*<fieldset>
		  <legend>Usuario y contraseña</legend>
		  <p><label>Name:</label> <input type="text" name="username" placeholder="$username"/></p>
		  <p><label>Password:</label> <input type="password" name="password" placeholder="$password"/><br /></p>
		  <button type="submit">Entrar</button>
		</fieldset>*/

        $camposFormulario=<<<EOF
        <fieldset>
            <h2>Introduce los datos de la nueva oferta</h2>
            <label for="name">Puesto:</label>
            <input type="text" name="puesto">
            <br>
            <label for="sueldo">Sueldo:</label>
            <input type="number" name="sueldo">
            <br>
            <label for="horas">Horas:</label>
            <input type="number" min="0" max="20" name="horas">
            <br>
            <label for="plazas">Plazas:</label>
            <input type="number" name="plazas">
            <br>
            <label for="fecha-inicio">Fecha inicio:</label>
            <input type="date" name="fecha-inicio">
            <br>
            <label for="fecha-fin">Fecha fin:</label>
            <input type="date" name="fecha-fin">
            <br>
            <label for="descripcion">Descripción:</label>
            <textarea type="text" name="descripcion"></textarea>
            <br>
            <button type="submit" tabindex="-1">Aceptar</button>
        </fieldset>
EOF;
        return $camposFormulario;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario($datos) {
        // ToDo: Validar los datos recibidos para crear una nueva oferta
        
        return $result;
    }
}
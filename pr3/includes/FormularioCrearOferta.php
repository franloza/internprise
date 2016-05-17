<?php

namespace es\ucm\aw\internprise;

class FormularioCrearOferta extends Form
{
    public function __construct() {
        $opciones = array(
          "ajax" => false,
            "action" => "includes/ajaxRequest.php?val=CREAR_OFERTA",
            "class" => null,
            "enctype" => null
        );
        parent::__construct('formCrearOferta', $opciones);
    }

    protected function generaCamposFormulario ($datos) {
        $camposFormulario=<<<EOF
        <fieldset id="fieldset-crear-oferta">
            <h2>Introduce los datos de la nueva oferta:</h2>
            <label for="name">Puesto:</label>
            <input type="text" name="puesto">
            <br>
            <label for="sueldo">Sueldo (Mes):</label>
            <input type="number" name="sueldo">
            <br>
            <label for="horas">Horas (Semana):</label>
            <input type="number" min="0" max="40" name="horas">
            <br>
            <label for="plazas">Plazas:</label>
            <input type="number" name="plazas">
            <br>
            <label for="fecha_inicio">Fecha inicio:</label>
            <input type="date" name="fecha_inicio">
            <br>
            <label for="fecha_fin">Fecha fin:</label>
            <input type="date" name="fecha_fin">
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
        $result = Oferta::creaOferta($datos);
        if (is_array($result)) {
            $result[] = array();
            $result[] = 'La oferta no es válida';
        }
        else
            $result = \es\ucm\aw\internprise\Aplicacion::getSingleton()->resuelve('/dashboard.php');
        return $result;
    }
}
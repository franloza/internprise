<?php

namespace es\ucm\aw\internprise;

class FormularioCrearOferta extends Form
{
    public function __construct() {
        $opciones = array(
          "ajax" => false,
            "action" => "ajaxRequest.php?val=CREAR_OFERTA",
            "class" => null,
            "enctype" => null
        );
        parent::__construct('formCrearOferta', $opciones);
    }

    protected function generaCamposFormulario ($datos) {
        $camposFormulario=<<<EOF
        <div id="form-crear-oferta" class="col-md-12">

                <h2>Introduce los datos de la nueva oferta:</h2><br>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label for="puesto">Puesto:</label>
                        <input type="text" class="form-control" name="puesto" id="puesto">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group required">
                        <label for="sueldo">Sueldo:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="sueldo" id="sueldo">
                            <div class="input-group-addon">€</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group required">
                        <label for="horas">Horas:</label>
                        <select class="form-control" name="horas" id="horas">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group required">
                        <label for="plazas">Plazas:</label>
                        <input type="text" class="form-control" name="plazas" id="plazas">
                    </div>
                </div>       


                <div class="col-md-3">
                    <div class="form-group required">
                        <label for="fechaInicio">Fecha inicio:</label>
                        <div  class='input-group'>
                            <input type="text" id="datePickerInicio" class="form-control" name="fecha_inicio" id="fecha_inicio">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group required">
                        <label for="fechaFin">Fecha fin:</label>
                        <div class='input-group'>
                            <input type="text" id="datePickerFin" class="form-control" name="fecha_fin" id="fecha_fin">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="idiomas">Idiomas:</label>
                        <input type="text" class="form-control" name="idiomas" id="idiomas">
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <label for="aptitudes">Aptitudes:</label>
                    <div id="edit-aptitudes class="col-md-12">
                        <div id="all-aptitudes">
                            <div class="form-group col-xs-2">
                                <input type='text' class='form-control' name='aptitudes[]'/>
                            </div>
                        </div>
                        <div class='form-group col-md-2'>
                            <button type='button' class='btn btn-success' id='add-aptitud' onclick='addInputAptitud()'>+</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <label for="reqMinimos">Requisitos mínimos:</label>
                    <textarea class="form-control" name="reqMinimos" id="reqMinimos" rows="6"></textarea>
                </div>

                <div class="col-md-9 form-group required">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="6"></textarea>
                </div>
                <div class="col-md-12">
                    <br>
                    <button type='button' onclick='submitFormCrearOferta()' class="btn btn-success">Crear</button>
                </div>

        <script type="text/javascript">
            $(function () {
                $('#datePickerInicio').datepicker({format: 'yyyy/mm/dd'});
                $('#datePickerFin').datepicker({format: 'yyyy/mm/dd'});
            });
        </script>
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

    protected function generaHtmlErrores(){
        $result = 'La oferta no es válida';
        return $result;
    }
}
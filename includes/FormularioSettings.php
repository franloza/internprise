<?php

namespace es\ucm\aw\internprise;

use es\ucm\aw\internprise\Aplicacion as App;

class FormularioSettings extends Form{

    const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

    private $tipo;

    public function __construct($tipo) {
        $opciones = array('action'=>'ajaxRequest.php?val=SETTINGS');
        parent::__construct('formSettings'.'_'.$tipo, $opciones);
        $this->tipo = $tipo;
    }

    protected function generaCamposFormulario ($datos) {
        switch ($this->tipo) {
            case 'admin': {return self::generaCamposFormularioAdmin();break;}
            case 'estudiante': {return self::generaCamposFormularioEstudiante();break;}
            case 'empresa': {return self::generaCamposFormularioEmpresa();break;}
        }
    }

    private function generaCamposFormularioAdmin () {

        $app = Aplicacion::getSingleton();
        $id_administrador = $app->idUsuario();
        $user = UsuarioDAO::cargaAdministrador($id_administrador);

        $nombre = $user->getNombre();
        $apellidos = $user->getApellidos();
        $nombre_universidad = $user->getNombreUniversidad();
        $sexo = $user->getSexo();
        $direccion = $user->getDireccion();
        $localidad = $user->getLocalidad();
        $provincia = $user->getProvincia();
        $pais = $user->getPais();
        $web = $user->getWeb();
        $telefono = $user->getTelefono();
        $cp = $user->getCp();


        $hChecked = ($sexo == 'Hombre') ? "checked" : "";
        $mChecked = ($sexo == 'Mujer') ? "checked" : "";

        $content = <<<EOF
        <div id="formSettings">
            <div id="infoPersonal" class="col-xs-12">
                <div class="row"><h1> Información personal </h1> </div>
                <div class="col-xs-6">
                    <div class="form-group required">
                        <label for="dni">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="$nombre">
                    </div> 
                     <div class="form-group required">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" value="$apellidos"/>
                     </div>
                      <div class="form-group required">
                            <label for="nombre_universidad">Universidad:</label>
                            <input type="text" class="form-control" name="nombre_universidad" id="nombre_universidad" value="$nombre_universidad">
                      </div>
                       <div class="form-group required">
                            <label for="sexo">Sexo:</label>
                            <label class="radio-inline"><input type="radio" name="sexo" value="Hombre" $hChecked>Hombre</label>
                            <label class="radio-inline"><input type="radio" name="sexo" value="Mujer" $mChecked>Mujer</label>
                       </div>
                            <div class="form-group required">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" value="$direccion">
                        </div>
                        <div class="form-group required">
                            <label for="localidad">Localidad:</label>
                            <input type="localidad" class="form-control" name="localidad" id="localidad" value="$localidad">
                        </div> 
                    </div>           
                    <div class="col-xs-6">                      
                        <div class="form-group required">
                            <label for="provincia">Provincia:</label>
                            <input type="provincia" class="form-control" name="provincia" id="provincia" value="$provincia">
                        </div> 
                        
                        <div class="form-group required">
                            <label for="provincia">Código Postal:</label>
                            <input type="cp" class="form-control" name="cp" id="cp" value="$cp">
                        </div> 
                        
                        <div class="form-group required">
                            <label for="pais">Pais:</label>
                            <input type="pais" class="form-control" name="pais" id="pais" value="$pais">
                        </div>
                         <div class="form-group">
                            <label for="telefono_fijo">Teléfono:</label>
                            <input type="telefono_fijo" class="form-control" name="telefono_fijo" id="telefono" value="$telefono">
                        </div>
                        <label for="web">Web:</label>
                        <div class="icon-addon addon-md">    
                                 <label for="web" class="fa fa-globe" rel="tooltip"/>
                                 <input type="url" class="form-control" name="web" id="web" value="$web">
                         </div>
                    </div>             
            </div>
            <div class="col-xs-12">  
                <button type="submit" class="btn btn-default">Confirmar cambios</button>   
            </div>
        </div>   
EOF;
        return $content;
    }

    private function generaCamposFormularioEstudiante () {

        $app = Aplicacion::getSingleton();
        $id_estudiante = $app->idUsuario();
        $user = UsuarioDAO::cargaEstudiante($id_estudiante);

        $dni = $user->getDni();
        $nombre = $user->getNombre();
        $apellidos = $user->getApellidos();
        $grado = $user->getGrado();
        $nombre_universidad = $user->getNombreUniversidad();
        $sexo = $user->getSexo();
        $nacionalidad = $user->getNacionalidad();
        $direccion = $user->getDireccion();
        $fecha_nacimiento = $user->getFechaNacimiento();
        $localidad = $user->getLocalidad();
        $provincia = $user->getProvincia();
        $cp = $user->getCp();
        $pais = $user->getPais();
        $telefono_fijo = $user->getTelefonoFijo();
        $telefono_movil = $user->getTelefonoMovil();
        $descripcion = $user->getDescripcion();
        $localizacion = $user->getLocalizacion();
        $experiencia = $user->getExperiencia();
        $estudios = $user->getEstudios();
        $idiomas = $user->getIdiomas();
        $cursos = $user->getCursos();
        $redesSociales = $user->getRedesSociales();
        $web = $user->getWeb();
        $avatar = $user->getAvatar();
        $aptitudes = $user->getAptitudes();


        $hChecked = ($sexo == 'Hombre') ? "checked" : "";
        $mChecked = ($sexo == 'Mujer') ? "checked" : "";

        //Generar campos experiencia
        $camposExperiencia = "";
        for($x=1;$x<4;$x++){
            $puesto = $experiencia[$x-1][0];
            $duracion = $experiencia [$x-1][1];
            $camposExperiencia .= <<<EOF
                <div class='form-group col-xs-10'>
                  <label for='experiencia_puesto_$x'>Puesto:</label> 
                  <input type='text' class='form-control' name='experiencia_puesto_$x' id='experiencia_puesto_$x' value='$puesto'/> 
                 </div>
                 <div class='form-group col-xs-2'>
                  <label for='experiencia_duracion_$x'>Duración (meses):</label> 
                  <input type='number' min = '0' class='form-control' name='experiencia_duracion_$x' id='experiencia_duracion_$x' value='$duracion'/> 
                </div>
EOF;
        }

        //Generar campos estudios
        $camposEstudios = "";
        for($x=1;$x<4;$x++){
            $titulo = $estudios[$x-1][0];
            $centro = $estudios [$x-1][1];
            $camposEstudios .= <<<EOF
                <div class='form-group col-xs-6'>
                  <label for='estudios_titulo_$x'>Título:</label> 
                  <input type='text' class='form-control' name='estudios_titulo_$x' id='estudios_titulo_$x' value='$titulo'/> 
                 </div>
                 <div class='form-group col-xs-6'>
                  <label for='estudios_centro_$x'>Centro de impartición:</label> 
                  <input type='text' class='form-control' name='estudios_centro_$x' id='estudios_centro_$x' value='$centro'/> 
                </div>
EOF;
        }

        //Generar campos idiomas
        $camposIdiomas = "";
        for($x=1;$x<4;$x++){
            $idioma = $idiomas[$x-1][0];
            $nivel = $idiomas [$x-1][1];
            $camposIdiomas .= <<<EOF
                <div class='form-group col-xs-3'>
                  <label for='idiomas_idioma_$x'>Idioma:</label> 
                  <input type='text' class='form-control' name='idiomas_idioma_$x' id='idiomas_idioma_$x' value='$idioma'/> 
                 </div>
                 <div class='form-group col-xs-1'>
                  <label for='idiomas_nivel_$x'>Nivel:</label> 
                  <select class="form-control" name='idiomas_nivel_$x' id='idiomas_nivel_$x' value='$nivel'>
                        <option>A1</option>
                        <option>A2</option>
                        <option>B1</option>
                        <option>B2</option>
                        <option>C1</option>
                        <option>C2</option>
                  </select>
                </div>
EOF;
        }

        //Generar campos cursos
        $camposCursos = "";
        for($x=1;$x<4;$x++){
            $titulo = $cursos[$x-1][0];
            $horas = $cursos [$x-1][1];
            $camposCursos .= <<<EOF
                <div class='form-group col-xs-10'>
                  <label for='cursos_titulo_$x'>Título:</label> 
                  <input type='text' class='form-control' name='cursos_titulo_$x' id='cursos_titulo_$x' value='$titulo'/> 
                 </div>
                 <div class='form-group col-xs-2'>
                  <label for='cursos_horas_$x'>Duración (horas):</label> 
                  <input type='number' min = '0' class='form-control' name='cursos_horas_$x' id='cursos_horas_$x' value='$horas'/> 
                </div>
EOF;
        }

        //Generar campos aptitudes
        $camposAptitudes = "<div id='edit-aptitudes' class='col-xs-12'><div id='all-aptitudes'>";
        if(isset($aptitudes)){
            foreach($aptitudes as $aptitud){
                $camposAptitudes .= <<<EOF
                <div class='form-group col-xs-2'>
                  <input type='text' class='form-control' name='aptitudes[]' value='$aptitud'/>
                 </div>
EOF;
            }
        }
        $camposAptitudes .=
            " <div class='form-group col-xs-2'>".
            " <input type='text' class='form-control' name='aptitudes[]'/></div></div>".
            " <button type='button' class='btn btn-success' id='add-aptitud' onclick='addInputAptitud()'> + </button>".
            "</div>";

        $content = <<<EOF
            <div id="formSettings">
                <div id="infoPersonal" class="col-xs-12">
                    <div class="row"><h1> Información personal </h1> </div>
                    <div class="col-xs-6">
                        <div class="form-group required">
                            <label for="dni">DNI:</label>
                            <input type="text" class="form-control" name="dni" id="dni" value="$dni">
                        </div>  
                        <div class="form-group required">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="$nombre"/>
                        </div> 
                        <div class="form-group required">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" value="$apellidos"/>
                        </div>
                        <div class="form-group required">
                            <label for="grado">Grado:</label>
                            <input type="text" class="form-control" name="grado" id="grado" value="$grado">
                        </div>
                        <div class="form-group required">
                            <label for="nombre_universidad">Universidad:</label>
                            <input type="text" class="form-control" name="nombre_universidad" id="nombre_universidad" value="$nombre_universidad">
                        </div>
                        <div class="form-group required">
                            <label for="sexo">Sexo:</label>
                            <label class="radio-inline"><input type="radio" name="sexo" value="Hombre" $hChecked>Hombre</label>
                            <label class="radio-inline"><input type="radio" name="sexo" value="Mujer" $mChecked>Mujer</label>
                        </div>
                        <div class="form-group required">
                            <label for="nacionalidad">Nacionalidad:</label>
                            <input type="text" class="form-control" name="nacionalidad" id="nacionalidad" value="$nacionalidad">
                        </div>
                        <div class="form-group required">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" value="$direccion">
                        </div>
                    </div>           
                    <div class="col-xs-6">                      
                        <div class="form-group required">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="$fecha_nacimiento">
                        </div> 
                        <div class="form-group required">
                            <label for="localidad">Localidad:</label>
                            <input type="localidad" class="form-control" name="localidad" id="localidad" value="$localidad">
                        </div> 
                        <div class="form-group required">
                            <label for="provincia">Provincia:</label>
                            <input type="provincia" class="form-control" name="provincia" id="provincia" value="$provincia">
                        </div> 
                        
                        <div class="form-group required">
                            <label for="provincia">Código Postal:</label>
                            <input type="cp" class="form-control" name="cp" id="cp" value="$cp">
                        </div> 
                        
                        <div class="form-group required">
                            <label for="pais">Pais:</label>
                            <input type="pais" class="form-control" name="pais" id="pais" value="$pais">
                        </div>
                         <div class="form-group">
                            <label for="telefono_fijo">Teléfono Fijo:</label>
                            <input type="telefono_fijo" class="form-control" name="telefono_fijo" id="telefono_fijo" value="$telefono_fijo">
                        </div>
                        <div class="form-group">
                            <label for="telefono_movil">Teléfono Móvil:</label>
                            <input type="telefono_movil" class="form-control" name="telefono_movil" id="telefono_movil" value="$telefono_movil">
                        </div>
                    </div>             
                </div>
                <div class="col-xs-12">
                <div class="row"><h1> Perfil </h1> </div>
                    <div class="form-group">
                        <label for="descripcion">Breve descripción:</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" value="$descripcion">
                    </div>
                    <div class="form-group">
                        <label for="localizacion">Localización:</label>
                        <input type="text" class="form-control" name="localizacion" id="localizacion" value="$localizacion"/>
                    </div> 
                    <h2> Experiencia </h2>                   
                     $camposExperiencia
                     <h2> Estudios </h2>                   
                     $camposEstudios
                     <h2> Idiomas </h2> 
                     $camposIdiomas
                     <h2> Otros cursos </h2> 
                     $camposCursos
                     <h2> Aptitudes </h2> 
                     $camposAptitudes
                     
                <h2> Redes Sociales </h2>   
                 <div class="form-group col-xs-3">
                     <label for="linkedin">LinkedIn:</label>
                     <div class="icon-addon addon-sm">
                         <label for="linkedin" class="fa fa-linkedin" rel="tooltip"/>
                         <input type="url" class="form-control" name="linkedin" id="linkedin" value="$redesSociales[2]">
                    </div>      
                 </div>
                 <div class="form-group col-xs-3">
                     <label for="twitter">Twitter:</label>
                     <div class="icon-addon addon-sm">
                         <label for="twitter" class="fa fa-twitter" rel="tooltip"/>
                         <input type="url" class="form-control" name="twitter" id="twitter" value="$redesSociales[3]">
                 </div>      
                 </div>  
                 <div class="form-group col-xs-3">
                     <label for="google_plus">Google +:</label>
                     <div class="icon-addon addon-sm">
                         <label for="google_plus" class="fa fa-google-plus" rel="tooltip"/>
                         <input type="url" class="form-control" name="google_plus" id="google_plus" value="$redesSociales[1]">
                  </div>      
                 </div>  
                 <div class="form-group col-xs-3">
                     <label for="skype">Skype:</label>
                     <div class="icon-addon addon-sm">
                         <label for="skype" class="fa fa-skype" rel="tooltip"/>
                         <input type="text" class="form-control" name="skype" id="skype" value="$redesSociales[0]">
                    </div>      
                 </div>  
                <div class="form-group col-xs-12">
                    <label for="web">Web:</label>
                    <div class="icon-addon addon-md">    
                             <label for="web" class="fa fa-globe" rel="tooltip"/>
                             <input type="url" class="form-control" name="web" id="web" value="$web">
                     </div>
                 </div>  
                </div> 
                <div class="col-xs-12">  
                    <button type="submit" class="btn btn-default">Confirmar cambios</button>   
                </div>
            </div>          

EOF;
        return $content;
    }

    private function generaCamposFormularioEmpresa () {
        $app = Aplicacion::getSingleton();
        $id_empresa = $app->idUsuario();
        $user = UsuarioDAO::cargaEmpresa($id_empresa);
        
        $cif = $user->getCif();
        $razonSocial = $user->getRazonSocial();
        $direccion = $user->getDireccion();
        $localidad = $user->getLocalidad();
        $provincia = $user->getProvincia();
        $pais = $user->getPais();
        $web = $user->getWeb();
        $telefono = $user->getTelefono();
        $cp = $user->getCp();

        $content = <<<EOF
       <legend id= "formSettings">Cambios en el perfil: </legend>
        <div id = "formSettingsLeft">
      <p><label>CIF:</label> <input type="text" name="cif" value="$cif"/></p>
      <p><label>Razon Social:</label> <input type="text" name="razonSocial" value="$razonSocial"/><br /></p>
      <p><label>Direccion:</label> <input type="text" size="50" name="direccion" value="$direccion"/></p>
      </div>
      <div id = "formSettingsRight">
      <p><label>Codigo Postal:</label> <input type="text" name="cp" value="$cp"/><br /></p>
      <p><label>Localidad:</label> <input type="text" name="localidad" value="$localidad"/></p>
      <p><label>Provincia:</label> <input type="text" name="provincia" value="$provincia"/><br /></p>
      <p><label>Pais:</label> <input type="text" name="pais" value="$pais"/></p>
      <p><label>Web:</label> <input type="text" name="web" value="$web"/><br /></p>
      <p><label>Telefono:</label> <input type="text" name="telefono" value="$telefono"/></p>
      </div>
        <legend id= "formSettingsSubmit">
        <button class="btn btn-default" type="submit" id="formSettingsBotton">Confirmar cambios</button>
        </legend>
EOF;
        return $content;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario($datos) {

        $app = App::getSingleton();
        $rol = $app->rolUsuario();
        $email = $app->emailUsuario();
        $datos['email'] = $email;

        switch ($rol) {
            case 'Admin': {$result = Administrador::update($datos);break;}
            case 'Estudiante': {$result = Estudiante::update($datos);break;}
            case 'Empresa': {$result = Empresa::update($datos);break;}
            default:    $result='Hubo un problema con el envío. Envíe el formulario de nuevo';
        }

        $result = \es\ucm\aw\internprise\Aplicacion::getSingleton()->resuelve('/dashboard.php');

        return $result;
    }
}
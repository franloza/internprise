#Memoria Práctica 3 Internprise
![alt text](https://dl.dropboxusercontent.com/u/38801465/favicon-admin.png "Logo Internprise")

##Scripts de vista

Meter también diagramas de flujo entre los scripts.

- ```index.php```: Muestra la pantalla de login si el usuario no ha iniciado sesión, si no redirige a ```dashboard.php```.
- ```dashboard.php```: Se encarga de mostrar la pantalla principal de cada usuario, dependiendo del rol que tenga el usuario logeado se mostrará un portal u otro.

- ```login.php```:

##Scripts adicionales
 como configuración, clases, lógica de la aplicación, base de datos...<br>
 Dentro de ```includes/```:
 
 - ```config.php```: Establece los parámetros de configuración de la aplicación, como la conexión con la base de datos (host, usuario, contraseña, etc) y la resolución de rutas. Se encarga de inicializar el objeto de la clase Aplicación con los valores introducidos.
 - ```Aplicacion.php```: Clase que representa la aplicación en si, siempre se usa una única instancia de ella (patrón Singleton), provee de funciones para la gestión de sesiones, de usuarios y de la base de datos. 
 - ```Portal.php```: Clase abstracta que se encarga de generar los distintos elementos HTML de la aplicación.
 - ```PortalAdminstracion.php```: Hereda de Portal, genera los contenidos especificos para el rol administrador.
 - ```PortalEstudiante.php```: Hereda de Portal, genera los contenidos especificos para el rol estudiante.
 - ```PortalEmpresa.php```: Hereda de Portal, genera los contenidos especificos para el rol empresa.
 - ```Usuario.php```: Clase que representa a un usuario con cualquier rol, sus atributos son los datos básicos para localizar al usuario en la BD (id, email, contraseña y rol), también contiene funciones para realizar el login, buscar a un usuario y validarlo.
 - ```Administrador.php```: Hereda de Usuario, contiene más datos para representar el usuario con rol de administrador.
 - ```Empresa.php```: Hereda de Usuario, contiene más datos para representar el usuario con rol de empresa.
 - ```Estudiante.php```: Hereda de Usuario, contiene más datos para representar el usuario con rol de estudiante.
 - ```Form.php```: Clase de gestión de formularios. 
 - ```FormLogin.php```: Hereda de Form y se encarga de mostrar el formulario de login y procesar su contenido.
 - ```/comun/Error.php```: Clase encargada de generar HTML para comunicar al usuario diversos fallos.
 
##Estructura de la base de datos
 Tablas, campos y relaciones.
 Explicar cada tabla y su propósito...
 Diagrama de entidad relación.
 
##Prototipo funcional del proyecto
Login y una funcionalidad completa.

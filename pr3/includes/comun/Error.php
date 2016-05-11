<?php

namespace es\ucm\aw\internprise;

class Error {

public static function generaErrorPermisos()
    {
        $errorPage = <<<EOF
        <h1> Error de permisos </h1>
        <p> No tiene permisos para acceder a esta página. Puede volver a la página principal clickando <a href="index.php">aquí</a> </p>
EOF;
        return $errorPage;
    }

public static function generaErrorHead()
{
    $errorPage = <<<EOF
     <head>
        <meta charset=\"UTF-8\">
        <title>Error</title>
    </head>
EOF;
    return $errorPage;
}
}
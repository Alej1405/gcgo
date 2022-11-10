<?php

//base de datos globalCargo
function conectarDB() : mysqli{
    $db = new mysqli('localhost', 'root', '', 'gc-go');

    if (!$db) {
        echo "Erroe no se puede contectar con la base de datos";
        exit;
    }
    return $db;
}

//anñadir la clave al cambiar de computador pablo1405sss∫∫s
<?php

require 'funciones.php';
require 'CONFIG/database.php';
require '../vendor/autoload.php';

use App\Cliente;

$db = conectarDB();
Cliente::setDB($db);

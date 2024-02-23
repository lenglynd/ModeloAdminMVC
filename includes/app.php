<?php
require 'funciones.php';
require 'config/databade.php';
require __DIR__.'/../vendor/autoload.php';

$db = conectarDB();

use Models\ActiveRecord;

ActiveRecord::setDB($db);


?>
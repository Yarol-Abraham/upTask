<?php

require "environment.php"; // sustituir por env.php
require "db.php";
require 'utils.php';
require __DIR__ . '/../vendor/autoload.php';

use Model\ActiveRecord;

ActiveRecord::setDB($db); // conexion a la base de datos 

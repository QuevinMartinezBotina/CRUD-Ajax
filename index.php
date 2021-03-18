<?php

require_once "bin/conexion/Conexion.php";
require_once "bin/persistencia/crud.php";

$crud = new Crud("usuario");
$id = $crud->insert([
    "nombres" => "John",
    "apellidos" => "Smith",
    "edad" => 18,
    "correo" => "jhon@gmail.com",
    "telefono" => "123",
    "fecha_registro" => date("Y-m-d H:i:s")
]);

echo "El ID INSERTADO ES: " . $id;
echo "<br/>";
$lista = $crud->get();
echo "<pre>";
var_dump($lista);
echo "</pre>";

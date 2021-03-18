<?php

require_once "bin/conexion/Conexion.php";
require_once "bin/persistencia/crud.php";

$crud = new Crud("usuario");
$filasAfectadas = $crud->where("id", "=", 1)->update(["nombres" => "juan"]);

$eliminados = $crud->where("id", "=", 6)->delete();

echo "FILAS AFECTADAS: " . $filasAfectadas . " ELIMINADOS: " . $eliminados;
echo "<br/>";
$lista = $crud->get();
echo "<pre>";
var_dump($lista);
echo "</pre>";

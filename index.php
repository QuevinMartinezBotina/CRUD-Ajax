<?php

require_once './bin/conexion/Conexion.php';
require_once './bin/persistencia/Crud.php';
require_once './bin/persistencia/modelo/ModeloGenerico.php';
require_once './bin/persistencia/modelo/Usuarios.php';
require_once './bin/http/ControladorUsuarios.php';

$controladorUsuarios = new ControladorUsuarios();
/* $respuesta = $controladorUsuarios->insertarUsuario([
    "nombres" => "JJ13",
    "edad" => 22,
    "email" => "email3@gmail.com",
    "asdfasfda" => "sdfasdfa"
]); */
/* $usuario = [
    "idUsuario" => 8,
    "correo" => "correo@gmail.com",
    "telefono" => "123456789"
];
$respuesta = $controladorUsuarios->actualizarUsuario($usuario);
var_dump($respuesta);
echo "<br/>"; */


/* $respuesta = $controladorUsuarios->eliminarUsuario(13);
var_dump($respuesta);
echo "<br/>"; */
/* 
$respuesta = $controladorUsuarios->buscarUsuarioPorId(11);
var_dump($respuesta);
echo "<br/>"; */

/* echo "<br/>";
$respuesta = $controladorUsuarios->listarUsuarios();
var_dump($respuesta); */

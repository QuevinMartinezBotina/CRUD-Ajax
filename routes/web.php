<?php

/* Route::get("/", ControladorUsuarios::class . "@listarUsuarios");

Route::get("/saludame/:nombre", function ($nombre, Request $request) {
    return "Hola " . $nombre . " tu edad es " . $request->edad . " años.";
}); */

Route::get("/", ControladorUsuarios::class);
Route::get("/listar_usuarios", ControladorUsuarios::class);
Route::get("/usuarios/form/crear", ControladorUsuarios::class . "@fromCrearUsuario");

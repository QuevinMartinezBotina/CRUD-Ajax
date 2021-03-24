<?php

//VISTAS
Route::get("/", ControladorUsuarios::class);
Route::get("/listar_usuarios", ControladorUsuarios::class);
Route::get("/usuarios/form/crear", ControladorUsuarios::class."@formCrearUsuario");

//RECURSOS
Route::post("/usuarios/registrar", ControladorUsuarios::class."@insertarUsuario");
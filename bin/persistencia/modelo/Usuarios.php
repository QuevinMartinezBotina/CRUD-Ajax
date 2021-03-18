<?php

class Usuarios extends ModeloGenerico
{

    protected $id;
    protected $nombres;
    protected $apellidos;
    protected $edad;
    protected $correo;
    protected $telefono;
    protected $fecha_registro;

    public function __construct($propiedades = null)
    {
    }
}

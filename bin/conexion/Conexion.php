<?php


class Conexion
{

    private $conexion;
    private $configuracion = [
        "driver" => "mysql",
        "host" => "localhost",
        "database" => "crud-ajax",
        "port" => "3306",
        "username" => "root",
        "password" => "",
        "charset" => "utf8mb4"
    ];

    public function __construct()
    {
    }

    public function conectar()
    {
        try {
            $CONTORLADOR = $this->configuracion["driver"];
            $SERVIDOR = $this->configuracion["host"];
            $BASE_DATOS  = $this->configuracion["database"];
            $PUERTO = $this->configuracion["port"];
            $USUARIO = $this->configuracion["username"];
            $CLAVE = $this->configuracion["password"];
            $CODIFICACION = $this->configuracion["charset"];

            $url = "{$CONTORLADOR}:host={$SERVIDOR}:{$PUERTO};"
                . "dbname={$BASE_DATOS};charset={$CODIFICACION}";

            $this->conexion = new PDO($url, $USUARIO, $CLAVE);

            echo "Conectado";
        } catch (Exception $exec) {
            echo $exec->getTraceAsString();
            echo "No Conectado";
        }
    }
}

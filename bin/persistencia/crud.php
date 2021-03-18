<?php

class  Crud
{
    /* Aqui declaramos variables que vamos  estar utlizando */
    protected $tabla;
    protected $conexion;/*contien la referenci a la conexion con la base de datos */
    protected $where = "";
    protected $sql = null;

    public function __construct($tabla = null)
    {
        /* se crea uan instancia para invocarlo en esta linea solamente */
        $this->conexion = (new Conexion())->conectar();
        $this->tabla = $tabla;
    }

    ///////////////////////////////////////////////////
    /* -------LIST ALL DATA TABLE------------ */
    ///////////////////////////////////////////////////

    public function get()
    {
        try {
            /* primero la consulta SQL */
            $this->sql = "SELECT * FROM {$this->tabla} {$this->where}";
            /* Luego prepramos esa consulta */
            $sth = $this->conexion->prepare($this->sql);
            /* Y pro ultimo la ejecutamos */
            $sth->execute();
            /* Y esa cosnulta la metemso en un array asociativo */
            return $sth->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $exec) {
            echo $exec->getTraceAsString();
            echo "No Conectado";
        }
    }


    ///////////////////////////////////////////////////
    /* -------INSERT DATA ON THE TABLE------------ */
    ///////////////////////////////////////////////////

    public function insert($obj)
    {
        try {
            /* Aqui colcoamos los campos con las comillas esas */
            $campos = implode("`, `", array_keys($obj)); //nombre`, `apellido`, `edad
            /* Luego pasamos los valores */
            $valores = ":" . implode(", :", array_keys($obj)); //:nombre, :apellido, :edad
            /* Y aqui colocamos los campos y sus valores */
            $this->sql = "INSERT INTO {$this->tabla} (`{$campos}`) VALUES ({$valores})";
            $this->ejecutar($obj);
        } catch (Exception $exec) {
            echo $exec->getTraceAsString();
        }
    }

    ///////////////////////////////////////////////////
    /* -------UPDATE DATA OF THE TABLE------------ */
    ///////////////////////////////////////////////////

    public function update($obj)
    {
        try {
            /* Aqui concatenamos el string */
            $campos = "";
            /* Aqui recorremos las llaves de nuestro objeto */
            foreach ($obj as $llave => $valor) {
                $campos .= "`$llave`=:$llave,"; //`nombres`=:nombres,`edad`=:edad
            }
            /* Aqui hacemos una limpieza para quitar espaciso en blanco */
            $campos = rtrim($campos, ",");
            $this->sql = "UPDATE {$this->tabla} SET {$campos} {$this->where}"; /* :nombre, :apellido, :edad */

            /* Aqui le pasamos para hacer la verificación y ejecutarlo */
            $filasAfectadas = $this->ejecutar($obj);
            return $filasAfectadas;
        } catch (Exception $exec) {
            echo $exec->getTraceAsString();
        }
    }

    ////////////////////////////////////////////////////
    /* -------DELETE DATA OF THE TABLE------------ */
    ///////////////////////////////////////////////////

    public function delete()
    {
        try {
            $this->sql = "DELETE FROM {$this->tabla} {$this->where}";
            $filesAfectadas = $this->ejecutar();
        } catch (Exception $exec) {
            echo $exec->getTraceAsString();
        }
    }


    public function where(
        $llave,
        $condicion,
        $valor
    ) {
        $this->where .= (strpos($this->where, "WHERE")) ? " AND " : " WHERE ";
        $this->where .= "`$llave` $condicion " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " ";
        return $this;
    }

    public function orWhere($llave, $condicion, $valor)
    {
        $this->where .= (strpos($this->where, "WHERE")) ? " OR " : " WHERE ";
        $this->where .= "`$llave` $condicion " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " ";
        return $this;
    }



    private function ejecutar($obj = null)
    {
        /* Aqui lo que hago es consultar lo datos de consulta, si tiene  valor o no*/
        $sth = $this->conexion->prepare($this->sql);
        if ($obj !== null) {
            foreach ($obj as $llave => $valor) {
                if (empty($valor)) {
                    $valor = NULL;
                }
                $sth->bindValue(":$llave", $valor);
            }
        }
        $sth->execute();
        $this->reiniciarValores();

        /* Aqui retornamos el numero de filas que fueron afectadas */
        return $sth->rowCount();
    }

    private function reiniciarValores()
    {
        $this->where = "";
        $this->sql = null;
    }
}

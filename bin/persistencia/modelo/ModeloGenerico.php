<?php

class ModeloGenerico extends Crud
{
    private $className;
    private $excluir = ["className", "tabla", "conexion", "where", "sql", "excluir"];


    function __construct($tabla, $className, $propiedades = null)
    {
        parent::__construct($tabla);
        $this->clasName = $className;

        if (empty($propiedades)) {
            return;
        }

        foreach ($propiedades as $llave => $valor) {
            $this->{$llave} = $valor;
        }
    }

    protected function obtenerAtributos()
    {
        /* Nnos mete los atributosvariable dentro de un array */
        $variables = get_class_vars($this->className);
        $atributos = [];
        $max = count($variables);
        /*hacemos unr ecorrido a esa variables*/
        foreach ($variables as $llave => $valor) {
            /* Hacemos una comprobación y si el atributo no es niguno de los que estamos excluyendo 
            entonces que me lo agregue a atributos, ya que sera un atributo que si esta permitido  */
            if (!in_array($llave, $this->excluir)) {
                $atributos[] = $llave;
            }
        }
        return $atributos;
    }

    protected function parsear($obj = null)
    {
        try {
            /* Obtenemos el objeto desde el modelo */
            $atributos = $this->obtenerAtributos();
            $ObjetoFinal = [];

            /* Comprobamos si el objeto es null */
            if ($obj = null) {
                foreach ($atributos as $indice => $llave) {
                    if (isset($this->{$llave})) {
                        $objetoFinal[$llave] = $this->{$llave};
                    }
                }
            }
        } catch (Exception $exec) {
            echo $exec->getTraceAsString();
        }
    }
}

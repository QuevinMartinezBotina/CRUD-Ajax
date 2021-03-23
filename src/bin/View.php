<?php

class View
{

    protected $variables;
    protected $ouput;

    function __construct()
    {
    }

    public function  render($file, $variables = null)
    {
        if (isset($variables) && is_array($variables)) {
            $this->variables = $variables;
        }

        $file = PATH_VIEWS . $file;
        ob_start();
        $this->includeFile($file);
        $ouput = ob_get_contents();
        ob_end_clean();
        return $ouput;
    }

    public function includeFile($file)
    {
        /* creamos variables en el teto actual */
        if (isset($this->variables) && is_array($this->variables)) {
            foreach ($this->variables as $key => $value) {
                global ${$key};
                ${$key} = $values;
            }
        }

        if (file_exists($file)) {
            return include $file;
        } else
        if (file_exists($file . ".php")) {
            return include $file . ".php";
        } else
        if (file_exists($file . ".html")) {
            return include $file . ".html";
        } else {
            echo "<h2>No existe el archivo: $file</h2>";
        }
    }
}

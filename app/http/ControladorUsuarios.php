<?php

class ControladorUsuarios {

    function __construct() {
        
    }

    public function insertarUsuario($usuario) {
        $usuarioModel = new Usuarios();
        $id = $usuarioModel->insert($usuario);
        $insersionExitosa = ($id > 0);
        $respuesta = new Respuesta($insersionExitosa ? EMensajes::INSERCION_EXITOSA : EMensajes::ERROR_INSERSION);
        $respuesta->setDatos($id);
        return $respuesta;
    }

    public function listarUsuarios() {
        $usuarioModel = new Usuarios();
        $lista = $usuarioModel->get();
        $v = count($lista);
        $respuesta = new Respuesta($v ? EMensajes::CORRECTO : EMensajes::ERROR);
        $respuesta->setDatos($lista);
        return $respuesta;
    }

    public function actualizarUsuario($usuario) {
        $usuarioModel = new Usuarios();
        $actualizados = $usuarioModel->where("id", "=", $usuario["idUsuario"])
                ->update($usuario);
        return [
            "codigo" => (($actualizados > 0) ? 1 : -1),
            "mensaje" => ($actualizados > 0) ? "Se ha actualizado el usuario correctamente." : "No se pudo actualizar el usuario.",
            "datos" => $actualizados
        ];
    }

    public function eliminarUsuario($idUsaurio) {
        $usuarioModel = new Usuarios();
        $eliminados = $usuarioModel->where("id", "=", $idUsaurio)->delete();
        return [
            "codigo" => (($eliminados > 0) ? 1 : -1),
            "mensaje" => ($eliminados > 0) ? "Se ha eliminado el usuario correctamente." : "No se pudo eliminado el usuario.",
            "datos" => $eliminados
        ];
    }

    public function buscarUsuarioPorId($idUsuario) {
        $usuarioModel = new Usuarios();
        $usuario = $usuarioModel->where("id", "=", $idUsuario)->first();
        return [
            "codigo" => (($usuario != null) ? 1 : -1),
            "mensaje" => ($usuario != null) ? "Se ha consultado el usuario correctamente." : "No se pudo consultar el usuario.",
            "datos" => $usuario
        ];
    }

}

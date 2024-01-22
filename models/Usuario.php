<?php
/* 
    In /models/Usuario.php
    Esta clase es responsable de operaciones relacionadas con los usuarios en la base de datos
*/
require_once 'config/conexion.php';
class Usuario extends Conectar
{
    public function insert_usuario($usu_nom, $usu_ape, $usu_correo)
    {
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "INSERT INTO tm_usuario (usu_id, usu_nom, usu_ape, usu_correo, est) VALUES
        (NULL, ?, ?, ?, '1');";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $usu_nom);
        $stmt->bindValue(2, $usu_ape);
        $stmt->bindValue(3, $usu_correo);
        $stmt->execute();
    }
    public function get_usuarios() {
        $conectar = parent::conexion();
        parent::set_name();
        $sql = "SELECT * FROM tm_usuario";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los usuarios
    }
}
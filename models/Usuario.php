<?php
/**
 * /models/Usuario.php
 * This class is responsible for operations related to users in the database.
 * It extends the Conectar class for database connection.
 */
require_once 'config/conexion.php';

/**
 * Class Usuario
 * Handles user-related operations in the database.
 */
class Usuario extends Conectar
{
    /**
     * Inserts a new user into the database.
     *
     * @param string $usu_nom User's name.
     * @param string $usu_ape User's surname.
     * @param string $usu_correo User's email address.
     * @return void
     */
    public function insert_usuario($usu_nom, $usu_ape, $usu_correo)
    {
        $conectar = parent::conexion();
        parent::set_name();

        // Prepare the SQL statement for insertion
        $sql = "INSERT INTO tm_usuario (usu_id, usu_nom, usu_ape, usu_correo, est) VALUES
        (NULL, ?, ?, ?, '1');";

        // Bind the input parameters to the prepared statement
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $usu_nom);
        $stmt->bindValue(2, $usu_ape);
        $stmt->bindValue(3, $usu_correo);

        // Execute the prepared statement
        $stmt->execute();
    }
     /**
     * Retrieves all users from the database.
     *
     * @return array An associative array of all users.
     */
    public function get_usuarios() {
        $conectar = parent::conexion();
        parent::set_name();

        // Prepare and execute the SQL statement for selection
        $sql = "SELECT * FROM tm_usuario";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();

        // Fetch and return all user records
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
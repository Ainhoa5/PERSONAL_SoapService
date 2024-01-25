<?php
/**
 * /config/conexion.php
 * Responsible for establishing the connection with the MySQL database.
 */

/**
 * Class Conectar
 * Handles database connections and operations.
 */
class Conectar
{
    /**
     * @var PDO|false Holds the database connection handler.
     */
    protected $dbh;

    /**
     * Establishes a connection to the MySQL database.
     * 
     * @return PDO|false Returns a PDO connection object or false on failure.
     */
    protected function conexion()
    {
        try {
            // Initialize the PDO connection with MySQL database credentials
            $conectar = $this->dbh = new PDO('mysql:host=localhost;dbname=andercode_soap', 'root', '');
            return $conectar;
        } catch (Exception $e) {
            // Print and terminate on error
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    /**
     * Sets the character encoding for the database connection to UTF-8.
     * 
     * @return bool Returns true on success or false on failure.
     */
    public function set_name()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }
}

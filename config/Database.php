<?php
// Database.php
class Database {
    private $host = "localhost";
    private $dbname = "biblioteca";  // Asegúrate de que el nombre de la base de datos sea correcto
    private $username = "root";      // Usuario de la base de datos
    private $password = "";          // Contraseña de la base de datos

    public $conn;

    // Método para obtener la conexión a la base de datos
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, 
                                  $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

<?php
// classes/CRUD.php
class CRUD {
    private $conn;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear una reserva
    public function create($titulo, $autor, $fecha_reserva, $usuario, $fecha_entrega) {
        $query = "INSERT INTO reservas (titulo, autor, fecha_reserva, usuario, fecha_entrega)
                  VALUES (:titulo, :autor, :fecha_reserva, :usuario, :fecha_entrega)";

        $stmt = $this->conn->prepare($query);

        // Vincula los parámetros
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':fecha_reserva', $fecha_reserva);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':fecha_entrega', $fecha_entrega);

        // Ejecuta la consulta y devuelve si fue exitosa
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para obtener una reserva por ID
    public function getReserva($id) {
        $query = "SELECT * FROM reservas WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // Verifica si encontró la reserva
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    // Método para actualizar una reserva
    public function update($id, $titulo, $autor, $fecha_reserva, $usuario, $fecha_entrega) {
        $query = "UPDATE reservas SET titulo = :titulo, autor = :autor, fecha_reserva = :fecha_reserva, 
                  usuario = :usuario, fecha_entrega = :fecha_entrega WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        // Vincula los parámetros
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':fecha_reserva', $fecha_reserva);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':fecha_entrega', $fecha_entrega);

        // Ejecuta la consulta y devuelve si fue exitosa
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para obtener todas las reservas
    public function read() {
        $query = "SELECT * FROM reservas";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    // Método para eliminar una reserva
    public function delete($id) {
        $query = "DELETE FROM reservas WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>

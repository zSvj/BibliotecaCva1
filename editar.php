<?php
// Incluir archivos de configuración y clases
include 'config/Database.php';
include 'classes/CRUD.php';

// Crear instancia de la base de datos y CRUD
$database = new Database();
$db = $database->getConnection();
$crud = new CRUD($db);

// Verificar si se ha enviado el ID de la reserva a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reserva = $crud->getReserva($id);

    // Si no se encuentra la reserva, redirigir
    if (!$reserva) {
        echo "<script>alert('Reserva no encontrada.'); window.location.href='index.php';</script>";
        exit;
    }
}

// Inicializar variables para mensajes
$message = '';
$alertType = '';

// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $usuario = $_POST['usuario'];
    $fecha_entrega = $_POST['fecha_entrega'];

    if ($crud->update($id, $titulo, $autor, $fecha_reserva, $usuario, $fecha_entrega)) {
        $message = "Reserva actualizada exitosamente";
        $alertType = "success";
    } else {
        $message = "Hubo un error al actualizar la reserva";
        $alertType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card fade-in">
            <div class="card-header">
                <h2>Editar Reserva</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="editar.php">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reserva['id']); ?>">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($reserva['titulo']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="autor">Autor:</label>
                        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($reserva['autor']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_reserva">Fecha de Reserva:</label>
                        <input type="date" class="form-control" id="fecha_reserva" name="fecha_reserva" value="<?php echo htmlspecialchars($reserva['fecha_reserva']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo htmlspecialchars($reserva['usuario']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_entrega">Fecha de Entrega:</label>
                        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?php echo htmlspecialchars($reserva['fecha_entrega']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Actualizar Reserva</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3 ```php
.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Mostrar SweetAlert después de la actualización
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($message): ?>
                Swal.fire({
                    title: '<?php echo $alertType === "success" ? "Éxito" : "Error"; ?>',
                    text: '<?php echo $message; ?>',
                    icon: '<?php echo $alertType; ?>',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php';
                    }
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>
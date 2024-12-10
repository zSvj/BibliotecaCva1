<?php
// Incluir archivos de configuración y clases
include 'config/Database.php';
include 'classes/CRUD.php';

// Crear instancia de la base de datos y CRUD
$database = new Database();
$db = $database->getConnection();
$crud = new CRUD($db);

// Verificar si se ha enviado el ID para eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($crud->delete($id)) {
        $message = "Reserva eliminada exitosamente";
        $alertType = "success";
    } else {
        $message = "Hubo un error al eliminar la reserva";
        $alertType = "error";
    }
} else {
    $message = "No se ha proporcionado un ID de reserva";
    $alertType = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Reserva</title>
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
                <h2>Eliminar Reserva</h2>
            </div>
            <div class="card-body">
                <p>¿Está seguro de que desea eliminar esta reserva?</p>
                <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                <a href="eliminar.php?id=<?php echo $_GET['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta reserva?');"><i class="fas fa-trash"></i> Eliminar Reserva</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Mostrar SweetAlert después de la eliminación
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($message)): ?>
                Swal.fire({
                    title: '<?php echo $alertType === "success" ? "Éxito" : "Error"; ?>',
                    text: '<?php echo $message; ?>',
                    icon: '<?php echo $alertType; ?>',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php'; // Redirigir a la página principal
                    }
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>
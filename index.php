<?php
// Incluir archivos de configuración y clases
include 'config/Database.php';
include 'classes/CRUD.php';

// Crear instancia de la base de datos y CRUD
$database = new Database();
$db = $database->getConnection();
$crud = new CRUD($db);

// Leer las reservas
$reservas = $crud->read();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
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
    <div class="container mt-5 fade-in">
        <h2>Lista de Reservas</h2>
        <a href="crear.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Agregar Nueva Reserva</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Fecha de Reserva</th>
                    <th>Usuario</th>
                    <th>Fecha de Entrega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reserva = $reservas->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $reserva['id']; ?></td>
                        <td><?php echo $reserva['titulo']; ?></td>
                        <td><?php echo $reserva['autor']; ?></td>
                        <td><?php echo $reserva['fecha_reserva']; ?></td>
                        <td><?php echo $reserva['usuario']; ?></td>
                        <td><?php echo $reserva['fecha_entrega']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $reserva['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $reserva['id']; ?>)"><i class="fas fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a la página de eliminación
                    window.location.href = 'eliminar.php?id=' + id;
                }
            });
        }
    </script>
</body>
</html>
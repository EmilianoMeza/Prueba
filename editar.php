<?php
error_reporting(E_ALL);
session_start();

include 'library/conecta.php';

$Mensaje = "";
$id_Seleccionado = "";
$nombre_actual = "";
$direccion_actual = "";
$fecha_actual = "";

// 1. Detectar si el usuario seleccionó a alguien en el menú desplegable
if (isset($_POST['id_Usuario_Select'])) {
    $id_Seleccionado = $connect->real_escape_string($_POST['id_Usuario_Select']);

    if ($id_Seleccionado != "") {
        // Consultar los datos específicos de ese usuario
        $query_usuario = $connect->query("SELECT nombre, direccion, fechaNacimiento FROM usuarios WHERE idUsuario = '$id_Seleccionado'");
        
        if ($usuario = $query_usuario->fetch_assoc()) {
            $nombre_actual = $usuario['nombre'];
            $direccion_actual = $usuario['direccion'];
            $fecha_actual = $usuario['fechaNacimiento'];
        }
    }
}

// 2. Capturar alertas de éxito o error que mande querys.php por la URL
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success_update') {
        $Mensaje = "<div class='alert alert-info alert-dismissible fade show' role='alert'>
        <strong>¡Actualización Exitosa!</strong> El usuario ha sido modificado correctamente.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } elseif ($_GET['status'] == 'error') {
        $Mensaje = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>ERROR!</strong> Algo salió mal al intentar actualizar.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <!-- Implementación de tu Navbar -->
    <?php include 'components/navbar.php'; ?>

    <div class="container py-5">
        <h1 class="text-center">Modificar Usuario</h1>
        <p class="text-center text-muted">Selecciona un usuario registrado para editar sus datos</p>
        
        <div class="row mt-2">
            <div class="col-md-6 mx-auto">
                <?php echo $Mensaje; ?>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                
                <!-- RECUADRO 1: SELECTOR DE USUARIO -->
                <div class="card p-4 mb-4 shadow-sm">
                    <!-- onChange="this.form.submit()" hace que el formulario se envíe solo al cambiar de opción -->
                    <form action="editar.php" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Selecciona un Usuario:</label>
                            <select name="id_Usuario_Select" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Selecciona --</option>
                                <?php
                                // Traemos todos los usuarios para llenar el select
                                $todos_usuarios = $connect->query("SELECT idUsuario, nombre FROM usuarios");
                                while ($reg = $todos_usuarios->fetch_assoc()) {
                                    // Mantiene seleccionado al usuario en el menú después de recargar
                                    $selected = ($id_Seleccionado == $reg['idUsuario']) ? "selected" : "";
                                    echo "<option value='".$reg['idUsuario']."' $selected>".$reg['nombre']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- RECUADRO 2: FORMULARIO DE EDICIÓN (Solo se habilita si hay un usuario seleccionado) -->
                <?php if ($id_Seleccionado != ""): ?>
                <div class="card p-4 shadow-sm">
                    <!-- Apunta a tu central de consultas library/querys.php -->
                    <form action="library/querys.php" method="post">
                        
                        <!-- Campos ocultos requeridos por tu archivo querys.php -->
                        <input type="hidden" name="accion" value="actualizar">
                        <input type="hidden" name="id_Usuario" value="<?php echo $id_Seleccionado; ?>">
                
                        <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre</label>
                            <input type="text" name="Nombre" id="nombre" class="form-control" value="<?php echo $nombre_actual; ?>"/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="direccion">Dirección</label>
                            <input type="text" name="Direccion" id="direccion" class="form-control" value="<?php echo $direccion_actual; ?>"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="fechaNac">Fecha de nacimiento</label>
                            <input type="date" name="FechaNac" id="fechaNac" class="form-control" value="<?php echo $fecha_actual; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info w-100 text-white fw-bold">Actualizar Datos</button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</html>

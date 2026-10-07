<?php
error_reporting(E_ALL);
session_start();

include 'library/conecta.php';

$Mensaje ="";

if(isset($_GET['status']))
    {
        if($_GET['status']=='success_insert')
            {
                $Mensaje="<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Registro Exitoso!</strong> Los datos están en la base de datos.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }elseif ($_GET['status'] == 'error')
            {
                $Mensaje = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>ERROR!</strong> Algo salió mal con la consulta.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
    }

//Eliminacion de esta linea debido a la creacion del archivo querys.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link  rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

    <?php include 'components/navbar.php';?>
    <div class="container">
        <h1 class="text-center mt-5">Registro de usuario</h1>
        <p class="text-center text-success">registra tus datos para iniciar sesion</p>
        <div class="col-md-6 mx-auto">
                <?php echo $Mensaje; ?>
        </div>
    </div>


    <div class="d-flex justify-content-center align-items-center bg-blue vh-100">
        <form action="library/querys.php" method="post" class="w-50">
    <!--Campos nuevos para que las querys funcionen-->
            <input type="hidden" name="accion" id="accion" value="insertar">
                <input type="hidden" name="id_Usuario" id="id_Usuario" value="">
        
        <div class="mb-3">
            <label class="form-label" for="nombre">Nombre</label>
            <input type="text" name="Nombre" id="nombre" class ="form-control"/><br>
        </div>
        <div class="mb-3">
            <label class="form-label" for="direccion">Direccion</label>
            <input type="text" name="Direccion"  id="direccion" class="form-control"/><br>
        </div>

        <div class="mb-3">
            <label class="form-label" for="fechaNac">Selecciona tu fecha de nacimiento</label>
            <input type ="date" name="FechaNac" id="fechaNac" class="form-control"><br>
        </div>
        
<!--Nuevo boton de registrarS-->
        <div class="mb-3">
            <button type="submit" id="btnEnviar" class="btn btn-success">Registrar</button>
        </div>
        
    </form>
</div>

    
    
</body>
    <script src="assets/js/bootstrap.min.js.map"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</html>
<?php
error_reporting(E_ALL);
session_start();

include 'library/conecta.php';
$Mensaje ="";

if(isset($_POST['btnRegistrar'])){
    $Nombre = $connect->real_escape_string($_POST['Nombre']);
    $Direccion = $connect->real_escape_string($_POST['Direccion']);
    $FechaNac = $connect->real_escape_string($_POST['FechaNac']);
    

    if($Nombre==""){
        $Mensaje="<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>ERROR! </strong> El campo nombre esta vacio, digite su nombre.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }elseif ($Direccion==""){
        $Mensaje="<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>ERROR! </strong> El campo Direccion esta vacio, digite su Direccion.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
}elseif ($FechaNac==""){
        $Mensaje="<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>ERROR! </strong>Favor de introducir su fecha de nacimiento.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
} else 
    {
     //Registrar el usuario
            $Registro = "INSERT INTO usuarios(nombre, direccion, fechaNacimiento) VALUES('$Nombre', '$Direccion', '$FechaNac')";
            $RegistroE = $connect->query($Registro);
            if($RegistroE > TRUE ) {
                 $Mensaje="<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Registro Exitoso !</strong> Lo datos estan en la base de datos.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
   } 
}
    


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
    <div class="contailer">
        <h1 class="text-center mt-5">Registro de usuario</h1>
        <p class="text-center text-success">registra tus datos para iniciar sesion</p>
        <div class="row mt-2">
            <?php  echo $Mensaje; ?>
        </div>


    <div class="d-flex justify-content-center align-items-center bg-blue vh-100">
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <div class="mb-3">
            <label class="form-label">nombre</label>
            <input type="text" name="Nombre" id="nombre"/><br>
        </div>
        <div class="mb-3">
            <label class="form-label">direccion</label>
            <input type="text" name="Direccion"  id="direccion"/><br>
        </div>

        <div class="mb-3">
            <input type ="date" name="FechaNac" id="fechaNac" class="form-control">Selecciona tu fecha de nacimiento</label><br>
        </div>
        
        <div class="mb-3">
            <input type="submit" value="Registrar" name="btnRegistrar" class="btn btn-success">
        </div>
        
    </form>
</div>

    
    
</body>
    <script src="assets/js/bootstrap.min.js.map"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</html>
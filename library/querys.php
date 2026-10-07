<?php
    include 'conecta.php';
    session_start();

    $_SESSION['Mensaje'] ="";

    if(isset($_POST['accion']))
        {
            $accion = $_POST['accion'];

            switch ($accion)
            {
                case 'insertar':
                    $Nombre = $connect->real_escape_string($_POST['Nombre']);
                    $Direccion = $connect->real_escape_string($_POST['Direccion']);
                    $FechaNac =$connect->real_escape_string($_POST['FechaNac']);

                    $sql = "INSERT INTO usuarios(nombre,direccion,fechaNacimiento)
                            VALUES ('$Nombre','$Direccion','$FechaNac')";

                    $resultado = $connect->query($sql);

                    //metodo de comprobacion que nos regresara al index.php
                    if($resultado)
                        {
                            header("Location: ../index.php?status=success_insert");

                        } else{
                            header("Location: ../index.php?status=error");

                        }
                        exit();
                break;

                case 'actualizar':
                    $id_Usuario = $connect->real_escape_string($_POST['id_Usuario']);
                    $Nombre = $connect->real_escape_string($_POST['Nombre']);
                    $Direccion =$connect->real_escape_string($_POST['Direccion']);
                    $FechaNac = $connect->real_escape_string($_POST['FechaNac']);

                    $sql = "UPDATE usuarios SET nombre = '$Nombre', direccion = '$Direccion', fechaNacimiento = '$FechaNac'
                            WHERE idUsuario = '$id_Usuario'";

                    $resultado = $connect->query($sql);

                    if ($resultado) {
                        header("Location: ../editar.php?status=success_update");
                    } else {
                        header("Location: ../editar.php?status=error");
                    }


                    
                break;

                case 'eliminar':
                    $id_Usuario= $connect->real_escape_string($_POST['id_Usuario']);
                    


                    $sql = "DELETE FROM usuarios
                            WHERE idUsuario = '$id_Usuario'";

                    $resultado = $connect->query($sql);
                break;
            }
        }
?>
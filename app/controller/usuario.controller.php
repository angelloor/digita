<?php

    require '../model/usuario.model.php';

    if($_POST){
        $usuario = new Usuario();
        switch($_POST["accion"]){
            case "CONSULTAR":
                echo json_encode($usuario->ConsultarTodo());
            break;
            case "CONSULTAR_ID":
                echo json_encode($usuario->ConsultarPorId($_POST["idUsuario"]));
            break;
            case "GUARDAR":
                $NombrePersona = $_POST["NombrePersona"];
                $nombreUsuario = $_POST["nombreUsuario"];
                $clave = $_POST["clave"];
                $rolUsuario = $_POST["rolUsuario"];

              if($NombrePersona == ""){
                    echo json_encode("Debe ingresar el nombre de la persona");
                    return;
                }
              if($nombreUsuario == ""){
                    echo json_encode("Debe ingresar el nombre del usuario");
                    return;
                }
              if($clave == ""){
                    echo json_encode("Debe ingresar la clave del usuario");
                    return;
                }
              if($rolUsuario == ""){
                    echo json_encode("Debe ingresar el rol del usuario");
                    return;
                }
                $respuesta = $usuario->Guardar($NombrePersona, $nombreUsuario, $clave, $rolUsuario);
                echo json_encode($respuesta);
            break;
            case "MODIFICAR":
                $NombrePersona = $_POST["NombrePersona"];
                $nombreUsuario = $_POST["nombreUsuario"];
                $clave = $_POST["clave"];
                $rolUsuario = $_POST["rolUsuario"];
                $idUsuario = $_POST["idUsuario"];
              if($NombrePersona == ""){
                    echo json_encode("Debe ingresar la persona asignada para este usuario");
                    return;
                }
              if($nombreUsuario == ""){
                    echo json_encode("Debe ingresar el nombre del usuario");
                    return;
                }
              if($clave == ""){
                    echo json_encode("Debe ingresar la clave del usuario");
                    return;
                }
              if($rolUsuario == ""){
                    echo json_encode("Debe ingresar el rol del usuario");
                    return;
                }
                $respuesta = $usuario->Modificar($idUsuario, $NombrePersona, $nombreUsuario, $clave, $rolUsuario);
                echo json_encode($respuesta);
            break;
            case "ELIMINAR":
                $idUsuario = $_POST["idUsuario"];
                $respuesta = $usuario->Eliminar($idUsuario);
                echo json_encode($respuesta);
            break;
            case "CONSULTAR_ID_ROW":
                $ValorBuscar = $_POST["ValorBuscar"];
                $respuesta = $usuario->ConsultarPorIdRow($ValorBuscar);
                echo json_encode($respuesta);
            break;
            case "BORRARUSUARIOS":
                echo json_encode($usuario->borrarUsuarios());
            break;
        }
    }
?>
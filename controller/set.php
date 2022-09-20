<?php 
    require_once "../model/tarea.php";
    
    $parametro = $_GET ? $_GET['id'] : null;
    $accion = $parametro ? "Editar" : "Crear";

    $nombre_style = "";
    $descripcion_style = "";
    $fecha_style = "";
    $nombre = "";
    $descripcion = "";
    $fecha = "";
    $estado = "";
    $message = false;
    $text_message = "";
    $type_message = "";

    function message($type, $text){
        $GLOBALS["message"] = true;
        $GLOBALS["text_message"] = $text;
        $GLOBALS["type_message"] = $type;
    }

    if($parametro){
        $tarea = new Tarea();
        $tarea_info = $tarea->buscarTarea($parametro);

        $nombre = $tarea_info['nombre'];
        $descripcion = $tarea_info['descripcion'];
        $fecha = $tarea_info['fecha'];
        $estado = $tarea_info['estado'];
    }

    if($_POST){
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $fecha = trim($_POST['fecha']);
        $boton = $_POST['boton'];

        $nombre_style = isset($nombre) ? "OK" : "NOTOK";
        $descripcion_style = isset($descripcion) ? "OK" : "NOTOK";
        $fecha_style = isset($fecha) ? "OK" : "NOTOK";

        if($nombre_style == "NOTOK" || $descripcion_style == "NOTOK" || $fecha_style == "NOTOK"){
            message("danger", "Debe colocar todos los campos correctamente.");
        }
        else{
            $tarea = new Tarea();

            if($boton == 'Editar'){
                $estado = $_POST['estado'];
                $id = $_POST['id'];
                $respuesta = $tarea->editarTarea($id, $nombre, $descripcion, $fecha, $estado);
                if($respuesta == 1)
                {
                    header("Location: list.php");
                    die();
                }
                $parametro = $id;
                message("danger", "Error al editar.");
                $accion = "Editar";
                
            }
            else{
                $tarea->insertarTarea($nombre, $descripcion, $fecha);
                $nombre = "";
                $descripcion = "";
                $fecha = "";
                message("success", "Tarea creada.");
            }
        }
    }
?>
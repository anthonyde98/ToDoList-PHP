<?php 
    require_once "../model/tarea.php";
    $id = $_GET ? $_GET['id'] : null;
    
    if(!$id){
        header("Location: list.php");
        die();
    }

    $tarea = new Tarea();
    $tarea_info = $tarea->buscarTarea($id);
    $estado_color = ($tarea_info['estado'] == "todo" ? "red" : ($tarea_info['estado'] == "doing" ? "blue" : "green"));
    $estado_icon = ($tarea_info['estado'] == "todo" ? "times-circle" : ($tarea_info['estado'] == "doing" ? "scrubber" : "check-circle"));
    $estado_text = ($tarea_info['estado'] == "todo" ? "Por realizar" : ($tarea_info['estado'] == "Realizando" ? "scrubber" : "Realizada"));
?>
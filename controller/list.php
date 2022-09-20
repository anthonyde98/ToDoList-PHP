<?php 
    require_once "../model/tarea.php";
    $tarea = new Tarea();
    $tareas = $tarea->buscarTareas();
    $buscar = "";
    
    if($_POST){
        $id = $_POST['delete'];
        $tarea2 = new Tarea();
        $tarea2->eliminarTarea($id);
        header("Location: list.php");
        die();
    }

    if($_GET){
        $buscar = trim($_GET['buscar']);

        $tarea = new Tarea();
        $tareas = $tarea->buscarTareasConFiltro('%'.$buscar.'%');
    }
?>
<?php 
    require_once "component/top.php";
    require_once "../controller/set.php";
    require_once "component/logout.php";
?>

<div class="container">
    <div class="content">
        <h2 class="formulario-title card"><?php echo $accion ?> tarea</h2>
        <div class="formulario-container card">
            <form class="formulario" action="set.php" method="post">
                <input type="number" class="form-control" name="id" placeholder="ID" value="<?php echo $parametro ?>" hidden></input>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i style="<?php echo "color: ".(($nombre_style == "OK") ? "green" : (($nombre_style == "NOTOK") ? "red" : "black"))?>" class="fad fa-file-edit"></i></span>
                    <input type="text" class="form-control" name="nombre" placeholder="Tarea" value="<?php echo $nombre ?>" required></input>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i style="<?php echo "color: ".(($descripcion_style == "OK") ? "green" : (($descripcion_style == "NOTOK") ? "red" : "black"))?>" class="fad fa-clipboard-list"></i></span>
                    <textarea class="form-control" name="descripcion" placeholder="Descripción" required><?php echo $descripcion ?></textarea>
                </div>
                <div class="input-group mb-3">
                    <input type="datetime-local" class="form-control" style="<?php echo "border: 1px solid ".(($fecha_style == "OK") ? "green" : (($fecha_style == "NOTOK") ? "red" : "gray"))?>" name="fecha" value="<?php echo $fecha ?>" required></input>
                </div>
                <?php 
                    if($estado != ""){
                       echo '<div class="radios my-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="estado" value="done" '.($estado == "done" ? "checked" : "").'>
                                <label style="color: green" class="form-check-label"><i class="fad fa-check-circle"></i></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="estado" value="doing" '.($estado == "doing" ? "checked" : "").'>
                                <label style="color: blue" class="form-check-label"><i class="fad fa-scrubber"></i></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="estado" value="todo" '.($estado == "todo" ? "checked" : "").'>
                                <label style="color: red" class="form-check-label"><i class="fad fa-times-circle"></i></label>
                            </div>
                        </div>';
                    }

                    if($message){
                        echo "<p style='box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5)' class='text-light rounded p-1 bg-".$type_message." text-center'>".$text_message."</p>";
                    }
                ?>
                <div class="btns-container">
                    <button type="submit" class="btn btn-primary" name='boton' value="<?php echo $accion ?>"><?php echo $accion ?></button>
                </div>
            </form>
        </div>
        <a href="list.php" class="btn btn-light mt-4 btn-index"><i class="fad fa-arrow-left"></i> Inicio</a>
    </div>
</div>

<?php 
    require_once "component/bottom.php"; 
?>
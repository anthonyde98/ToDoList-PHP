<?php 
    require_once "component/top.php";
    require_once "../controller/list.php";
    require_once "component/logout.php";
?>

<div class="container">
    <div class="content">
       <div class="title card">
            <h2><i class="fad fa-clipboard-list me-1"></i> Lista de tareas</h2>
       </div>
       <div class="todo card">
            <div class="extra d-flex justify-content-between flex-row-reverse mb-3">
                <a class="btn btn-success pe-3" href='set.php'><i class='fad fa-plus-circle info'></i> Agregar</a>
                <?php
                    if(($tareas && count($tareas) > 0) || $buscar){
                ?>
                <form action="list.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="buscar" placeholder="Buscar" value="<?php echo $buscar ?>">
                        <button title='Buscar' class="btn btn-primary" type='submit'><i class="fad fa-search"></i></button>
                    </div> 
                </form>
                <?php
                    }
                ?>
            </div>
            <?php
                if($tareas && count($tareas) > 0){
            ?>
            <table class="table table-borderless">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th scope="col">Tarea</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                        foreach($tareas as $tarea){
                            $estado_color = ($tarea['estado'] == "todo" ? "red" : ($tarea['estado'] == "doing" ? "blue" : "green"));
                            $estado = ($tarea['estado'] == "todo" ? "times-circle" : ($tarea['estado'] == "doing" ? "scrubber" : "check-circle"));
                            $estado_title = ($tarea['estado'] == "todo" ? "Por realizar" : ($tarea['estado'] == "Realizando" ? "scrubber" : "Realizada"));
                            echo "<tr>
                                <td>".$tarea['nombre']."</td>
                                <td>".ucfirst($formato->format(new DateTime($tarea['fecha'])))."</td>
                                <td><i title='".$estado_title."' style='color: ".$estado_color."' class='fad fa-".$estado."'></i></td>
                                <td class='accion'>
                                    <a title='Más información' href='details.php?id=".$tarea['id']."'><i class='fad fa-info-square info'></i></a>
                                    <a title='Editar' href='set.php?id=".$tarea['id']."'><i class='fad fa-pen-square edit'></i></a>
                                    <form action='list.php' method='post'>
                                        <button title='Eliminar' type='submit' value='".$tarea['id']."' name='delete' style='border: none; margin: 0; padding: 0; background-color: transparent'><i class='fad fa-times-square delete'></i></button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
            <?php             
                }
                else{
            ?> 
            <div class="nodata">
                <h5>No hay tareas que mostrar.</h5>
            </div>
            <?php             
                }   
            ?> 
       </div>
    </div>
</div>

<?php 
    require_once "component/bottom.php"; 
?>
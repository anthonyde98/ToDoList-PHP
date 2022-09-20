<?php 
    require_once "component/top.php";
    require_once "../controller/details.php";
    require_once "component/logout.php";
?>

<div class="container">
    <div class="content">
       <div class="title card">
            <h2><i class="fad fa-clipboard-list me-1"></i>Tarea</h2>
       </div>
       <div class="todo card">
            <table class="table table-borderless">
                <tbody class="body">
                    <tr>
                        <th>Nombre</th>
                        <td><?php echo $tarea_info['nombre'] ?></td>
                    </tr>
                    <tr>
                        <th>Descripción</th>
                        <td><?php echo $tarea_info['descripcion'] ?></td>
                    </tr>
                    <tr>
                        <th>Fecha para realizar</th>
                        <td><?php echo ucfirst($formato->format(new DateTime($tarea_info['fecha']))) ?></td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td>
                            <i style='color: <?php echo $estado_color?>' class='fad fa-<?php echo $estado_icon?>'></i> 
                            <?php echo $estado_text ?>
                        </td>
                    </tr>
                </tbody>
            </table>
       </div>
       <a href="list.php" class="btn btn-light mt-4"><i class="fad fa-arrow-left"></i> Inicio</a>
    </div>
</div>

<?php 
    require_once "component/bottom.php"; 
?>
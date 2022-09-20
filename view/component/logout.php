<?php 
    if($_POST){
        $boton = $_POST['boton'];
        if($boton == 'out'){         
            require_once "../../model/usuario.php";
            
            $usuario = new Usuario();
            $usuario->cerrarSesion();
        }
    }
?>

<form action="component/logout.php" method="post" class='logoutForm d-flex justify-content-center flex-column'>
    <button class='out-btn' title='Cerrar Sesión' name='boton' value='out'><i class="fad fa-sign-out"></i></button>
</form>
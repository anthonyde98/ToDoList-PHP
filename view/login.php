<?php 
    require_once "component/top.php";
    require_once "../controller/login.php";
?>

<div class="container">
    <div class="content">
        <div class="user-logo">
            <i class="fad fa-user"></i>
        </div>
        <h2 class="formulario-title card"><?php echo ($parametro || $boton == "Registrar" ? "Registrar" : "Iniciar") ?> sesión</h2>
        <div class="formulario-container card">
            <form class="formulario" action="login.php<?php echo ($parametro ? "?type=register" : "") ?>" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i style="<?php echo "color: ".(($correo_style == "OK") ? "green" : (($correo_style == "NOTOK") ? "red" : "black"))?>" class="fad fa-at"></i></span>
                    <input type="email" class="form-control" name="correo" placeholder="Correo" value="<?php echo $correo ?>" autocomplete="email" required></input>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i style="<?php echo "color: ".(($contrasena_style == "OK") ? "green" : (($contrasena_style == "NOTOK") ? "red" : "black"))?>" class="fad fa-key"></i></span>
                    <input type="password" class="form-control" name="contra" placeholder="Contraseña" value="<?php echo $contra ?>" autocomplete="current-password" required></input>
                </div>

                <?php 
                    if(!$parametro){
                        echo '<div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="check" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Recordar usuario
                            </label>
                        </div>';
                    }

                    if($parametro || $boton == "Registrar"){
                        echo '<div class="input-group mb-3">
                            <span class="input-group-text"><i style="color: '.(($contrasena2_style == "OK") ? "green" : (($contrasena2_style == "NOTOK") ? "red" : "black")).'" class="fad fa-key"></i></span>
                            <input type="password" class="form-control" name="contra2" placeholder="Repita la contraseña" value="'.$contra2.'" required></input>
                        </div>';
                    }

                    if($error){
                        echo '<p class="error">'.$error_message."</p>";
                    } 
                ?>
                <div class="btns-container">
                    <button type="submit" class="btn btn-primary" name="boton" value="<?php echo ($parametro || $boton == "Registrar" ? "Registrar" : "Iniciar") ?>"><?php echo ($parametro || $boton == "Registrar" ? "Registrar" : "Iniciar") ?></button>
                    <?php echo ($parametro || $boton == "Registrar" ? "" : "<a href='login.php?type=register' class='btn btn-info text-light'>Registrarse <i class='fad fa-arrow-right'></i></a>") ?> 
                </div>
            </form>
        </div>
        <?php echo ($parametro || $boton == "Registrar" ? "<a href='login.php' style='box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);' class='btn btn-light mt-4'><i class='fad fa-arrow-left'></i> Login</a>" : "") ?> 
    </div>
</div>

<?php 
    require_once "component/bottom.php"; 
?>
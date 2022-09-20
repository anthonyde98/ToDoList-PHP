<?php
    require_once "../model/usuario.php";
    
    $parametro = null;
    $cookies = null;

    if(isset($_GET)){
        if(isset($_GET['type'])){
            $parametro = $_GET['type'];
        }
        else if(isset($_GET['cookies'])){
            $cookies = $_GET['cookies'];
        }
    }
    
    if($cookies == "reset_cookie"){
        setcookie("usuario", "", time() - (9999999 * 30));
        header("Location: login.php");
        die();
    }

    if(isset($_COOKIE['usuario'])){
        session_start();
        $_SESSION['usuario'] = decryptCookie($_COOKIE['usuario']);
        header("Location: list.php");
        die();
    }

    $correo_style = "";
    $contrasena_style = "";
    $contrasena2_style = "";
    $correo = "";
    $contra = "";
    $contra2 = "";
    $error = false;
    $error_message = "";
    $boton = "";

    if($_POST){
        $correo = trim($_POST['correo']);
        $contra = trim($_POST['contra']);
        $correo_style = !filter_var($correo, FILTER_VALIDATE_EMAIL) ? "NOTOK" : "OK";
        $contrasena_style = strlen($contra) < 5 ? "NOTOK" : "OK";
        $boton = $_POST['boton'];

        $usuario = new Usuario();

        if($boton == "Registrar"){
            $contra2 = trim($_POST['contra2']);
            $contrasena2_style = strlen($contra2) < 5 ? "NOTOK" : "OK";

            if($correo_style == "NOTOK" || $contrasena_style == "NOTOK" || $contrasena2_style == "NOTOK"){
                $error = true;
                $error_message = "Debe colocar todos los campos correctamente.";
            }
            else{
                if($contra != $contra2){
                    $contrasena_style = "NOTOK";
                    $contrasena2_style = "NOTOK";
        
                    $error = true;
                    $error_message = "Las contraseñas deben coincidir.";
                }
                else{
                    $data = $usuario->registrar($correo, $contra);
                    if($data == -3){
                        $error = true;
                        $error_message = "Hubo un error al registrar.";
                        $correo_style = "NOTOK";
                        $contrasena_style = "NOTOK";
                        $contrasena2_style = "NOTOK";
                        $contra = "";
                        $contra2 = "";
                    }
                    else if($data == -1){
                        $error = true;
                        $error_message = "Este correo ya está en uso.";
                        $correo_style = "NOTOK";
                        $contrasena_style = "";
                        $contrasena2_style = "";
                        $contra = "";
                        $contra2 = "";
                    }
                    else{
                        session_start();
                        $_SESSION['usuario'] = $data;
                        header("Location: list.php");
                        die();
                    }
                }
            }
        }
        else{
            if($correo_style == "NOTOK" || $contrasena_style == "NOTOK"){
                $error = true;
                $error_message = "Debe colocar todos los campos correctamente.";
            }
            else{
                $recordar = isset($_POST['check']) ? filter_var($_POST['check'], FILTER_VALIDATE_BOOLEAN) : false;

                $data = $usuario->iniciarSesion($correo, $contra);
                if($data == -3){
                    $error = true;
                    $error_message = "Hubo un error al iniciar.";
                    $correo_style = "NOTOK";
                    $contrasena_style = "NOTOK";
                    $contra = "";
                }
                else if($data == -1){
                    $error = true;
                    $error_message = "Usuario no encontrado.";
                    $correo_style = "NOTOK";
                    $contrasena_style = "";
                    $contra = "";
                }
                else if($data == -2){
                    $error = true;
                    $error_message = "Contraseña incorrecta.";
                    $correo_style = "OK";
                    $contrasena_style = "NOTOK";
                    $contra = "";
                }
                else{
                    if($recordar){
                        setcookie("usuario", encryptCookie($data), time() + (86400 * 30));
                    }
                    session_start();
                    $_SESSION['usuario'] = $data;
                    header("Location: list.php");
                }
            }
        }
    }
?>
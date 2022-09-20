<?php
    session_start();
    date_default_timezone_set("America/Santo_Domingo");
    setlocale(LC_TIME, 'es_DO.UTF-8','esp');
    $formato = new IntlDateFormatter(
        'es-ES',
        IntlDateFormatter::FULL,
        IntlDateFormatter::SHORT,
        'America/Santo_Domingo',
        IntlDateFormatter::GREGORIAN
    );

    $pagina = explode('.', explode('/', $_SERVER['REQUEST_URI'])[3])[0];

    if(!$_SESSION && $pagina != 'login'){
        header("Location: login.php");
        die();
    }
    
    if($_SESSION && $_SESSION['usuario'] && $pagina == 'login'){
        header("Location: list.php");
        die();
    }

    function encryptCookie($cookiedata){
        $ciphering = "AES-128-CBC-HMAC-SHA256";
        $options = 0;
        $encryption_iv = 'abcdefghijklmnñopqrstwyxz0123456789';
        $encryption_key = "asdkljafdlkj1241kl3j4k31mna.flk1j341;laf/mafas.df,j1;kjrs";
        
        $encryption = openssl_encrypt($cookiedata, $ciphering,
                    $encryption_key, $options, $encryption_iv);
        
        return $encryption;
    }

    function decryptCookie($cookieEncryptedData){
        $ciphering = "AES-128-CBC-HMAC-SHA256";
        $options = 0;
        $decryption_iv = 'abcdefghijklmnñopqrstwyxz0123456789';
        $decryption_key = "asdkljafdlkj1241kl3j4k31mna.flk1j341;laf/mafas.df,j1;kjrs";
        
        $decryption=openssl_decrypt ($cookieEncryptedData, $ciphering, 
                $decryption_key, $options, $decryption_iv);
        
        return $decryption;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/<?php echo $pagina ?>.css">
    <link rel="icon" type="image/x-icon" href="assets/img/task.png">
    <title><?php echo ucfirst($pagina) ?></title>
</head>
<body>
    <div style="box-shadow: 0 4px 5px rgba(0, 0, 0, 0.5); top: 10px; left: 10px" class="card position-absolute d-flex flex-row justify-content-center m-3 p-3">
        <img style="height: 30px; width: 30px;" class="" src="assets/img/task.png"> <h4>Lista de tareas</h4>
    </div>
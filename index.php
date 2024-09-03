<?php
    require_once "./config/app.php";
    require_once "./autoload.php";

    /*---------- Iniciando sesión ----------*/
    require_once "./app/views/inc/session_start.php";

    if (isset($_GET['views'])) {
        $url = explode("/", $_GET['views']);
        $vista = $url[0]; // Obtenemos la vista que se debe cargar
    } else {
        $vista = "login"; // Vista por defecto si no hay nada en la URL
    }

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : null;
    
    $rutasVistas = [
        "login" => "./app/views/content/login-view.php",
        "logOut" => "./app/views/content/login-view.php",
        "dashboard" => "./app/views/content/dashboard-view.php",
        "inventario" => "./app/views/content/inventario-view.php",
        "404" => "./app/views/content/404-view.php",
        "detalles"=>"./app/views/content/details-view.php",
        "actualizar"=>"./app/views/content/actualizar-view.php",
        "busqueda" => "./app/views/content/bucar-view.php",
        "usuario"=> "./app/views/content/usuario-view.php",
        "usuario-Borrar" => "./app/views/content/eliminarUsuario-view.php",
        "actualizar-usuario" => "./app/views/content/actualizarProp-view.php"
        // Agrega aquí todas las vistas que quieras gestionar
    ];

    // Verificar si la vista existe en las rutas configuradas
    if (array_key_exists($vista, $rutasVistas)) {
        $vistaPath = $rutasVistas[$vista];
    } else {
        $vistaPath = $rutasVistas["404"]; // Si la vista no existe, mostrar el error 404
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/head.php"; ?>
    <?php if ($vista != "login" && $vista != "logOut") { require_once "./app/views/inc/nav-bar.php"; } ?>
</head>
<body>
    <?php
        
        use app\controller\loginController;

        $insLogin = new loginController();

        if($insLogin){
            require $vistaPath;
        }
        
        
    ?>
</body>
</html>

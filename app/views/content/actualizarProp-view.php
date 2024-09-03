<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}


$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : null;

if (!($cedula)) {
    // Realizar la lógica necesaria con $id y $cedula, como consultas a la base de datos
    echo "No se proporcionó información suficiente para mostrar los detalles.";

    // Aquí puedes añadir cualquier otra lógica que necesites para mostrar los detalles
} else {
    
    
}
?>

<div class="main content">
    <form class="box" id="registroForm" method="POST" action="<?php echo APP_URL; ?>app/controller/ActualizarusuarioController.php" autocomplete="off" enctype="multipart/form-data">
        <h1 class="title">Usuario</h1>
        <h2 class="subtitle">Actualizar Usuario</h2>
        
        <input type="hidden" name="modulo_usuario" value="registrar">
        <input type="hidden" name="cedula" value="<?php echo htmlspecialchars($cedula); ?>" name ="cedula">
        
        <div class="columns">
            <div class="column">
                <h5>Nombre</h5>
                <?php
                    $sql = "SELECT nombre  FROM propietario  WHERE cedula = :cedula";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':cedula', $cedula);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $valor_input = $resultado ? $resultado['nombre'] : ''; // Verifica si se encontró un resultado
                ?>
                <input class="input" placeholder="<?php echo htmlspecialchars($valor_input); ?>" type="text" name="nombre">
            </div>
            <div class="column">
                <h5>Apellido</h5>
                <?php
                    $sql = "SELECT apellido  FROM propietario  WHERE cedula = :cedula";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':cedula', $cedula);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $valor_input = $resultado ? $resultado['apellido'] : ''; // Verifica si se encontró un resultado
                ?>
                <input class="input" placeholder="<?php echo htmlspecialchars($valor_input); ?>" type="text" name="apellido">
            </div>
        </div>
        
        <div class="columns">
            <div class="column">
                <h5>Cargo</h5>
                <?php
                    $sql = "SELECT cargo  FROM propietario  WHERE cedula = :cedula";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':cedula', $cedula);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $valor_input = $resultado ? $resultado['cargo'] : ''; // Verifica si se encontró un resultado
                ?>
                <input class="input" placeholder="<?php echo htmlspecialchars($valor_input); ?>" type="text" name="cargo">
            </div>
            <div class="column">
                <div class="file is-small">
                    <label class="file-label">
                        <input class="file-input" type="file" name="foto" accept=".jpg, .png, .jpeg">
                        <span class="file-cta">
                            <span class="file-label">Seleccionar una imagen</span>
                        </span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="columns">
            <div class="column">
                <button type="submit" class="button is-info is-rounded">Actualizar</button>
                <a href="?views=usuario-Borrar" class="button is-info is-rounded ml-2">Atras</a>
            </div>
        </div>
    </form>
</div>

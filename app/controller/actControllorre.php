<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

$idOld = isset($_POST['id']) ? $_POST['id'] : null;
$cedulaOld = isset($_POST['cedula']) ? $_POST['cedula'] : null;

if ($idOld === null || $cedulaOld === null) {
    die("Parámetros no válidos.");
}

$id = $_POST['id'];
$id_modelo = $_POST['id_modelo'];
$id_procesador = $_POST['id_procesador'];
$id_almacenamiento = $_POST['id_almacenamiento'];
$id_ram = $_POST['id_ram'];
$id_grafica = $_POST['id_grafica'];
$id_office = $_POST['id_office'];
$id_windows = $_POST['id_windows'];
$office_licencia = $_POST['office_licencia'];
$windows_licencia = $_POST['windows_licencia'];
$serial = $_POST['serial'];
$cedula = $_POST['cedula'];
$fecha_entrega = $_POST['fecha_entrega'];
$id_estado = $_POST['id_estado'];
$fecha = $_POST['fecha'];
$id_mantenimiento = $_POST['id_mantenimiento'];
$mensajeUpdate = [];


if(!empty($id_modelo)){
    $sql = "UPDATE equipo SET id_modelo = :id_modelo WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':id_modelo', $id_modelo);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="Modelo";
        $mensajeUpdate[] = $msj;
    } else {
        $msj ="Modelo";
        $mensajeNotUpdate[]=$msj;

    }
}

if (isset($_FILES['foto_equipo']) && $_FILES['foto_equipo']['error'] == 0) {
    $foto = $_FILES['foto_equipo'];
    
    
    $ruta_destino = 'views/fotos/' . basename($foto['name']);
    
    // Mover la foto subida al directorio deseado
    if (move_uploaded_file($foto['tmp_name'], $ruta_destino)) {
        // Actualizar la base de datos con la nueva ruta de la foto
        $sql = "UPDATE equipo SET foto = :foto WHERE id = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':foto', $ruta_destino);
        $stmt->bindParam(':id', $id);
        if($stmt->execute() ){
            
            $msj ="foto";
            $mensajeUpdate[] = $msj;
        }else{
            echo "<script>
            alert('No se actualizó ningún campo.');
            window.location.href = 'http://localhost/inventario/?views=inventario/';
        </script>";
        }
        
    } else {
        $msj ="fotitio";
        $mensajeNotUpdate[]=$msj;
    }
}


if (!empty($mensajeUpdate)) {
    $mensaje = "Campos actualizados: " . addslashes(implode(", ", $mensajeUpdate));
    echo "<script>
        alert('$mensaje');
        window.location.href = 'http://localhost/inventario/?views=inventario/';
    </script>";
} else {
    echo"<script>
        alert('No se actualizó ningún campo. $contador');
        window.location.href = 'http://localhost/inventario/?views=inventario/';
    </script>";
}

// Cerrar la conexión
$conn = null;
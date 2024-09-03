<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cargo = $_POST['cargo'];

if($cedula == null || $nombre == null || $apellido == null){
    die("parametros no validos");
}

$sql = "DELETE FROM propietario WHERE cedula = :cedula AND nombre = :nombre AND apellido = :apellido";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':cedula', $cedula);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);

if($stmt->execute()){
    $sql = "DELETE FROM equipo_usuario WHERE cedula = :cedula";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cedula', $cedula);
    if($stmt->execute()){
        echo "<script>
            alert('Persona $nombre eliminado $id ');
            window.location.href = 'http://localhost/inventario/?views=usuario/';
        </script>";
        exit;
    }
    
}
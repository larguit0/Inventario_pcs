<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

$id = isset($_POST['id']) ? $_POST['id'] : null;
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : null;

if ($id === null || $cedula === null) {
    die("Parámetros no válidos.");
}

$sql = "DELETE FROM equipo WHERE id = :id";  
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);

if($stmt->execute()){

    echo "<script>
            alert('Equipo eliminado $id ');
            window.location.href = 'http://localhost/inventario/?views=inventario/';
        </script>";
        exit;
}
?>

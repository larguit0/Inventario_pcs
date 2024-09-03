<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cargo = $_POST['cargo'];

if (empty($nombre) && empty($apellido) && empty($cargo)) {
    echo "<script>
        alert('Por favor, llene todos los campos.');
        window.location.href = 'http://localhost/inventario/?views=usuario/';
    </script>";
    die();  // Agregar die() para evitar que continúe la ejecución
}

$sql = "SELECT * FROM propietario WHERE nombre = :nombre AND apellido = :apellido";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);
$stmt->execute();
$exists = $stmt->fetchColumn();

if ($exists) {
    echo "<script>
        alert('La persona se encuentra en la base de datos');
        window.location.href = 'http://localhost/inventario/?views=usuario/';
    </script>";
    die();  
} else {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $max_size = 5 * 1024 * 1024; // 5 MB

        if (in_array($_FILES['foto']['type'], $allowed_types) && $_FILES['foto']['size'] <= $max_size) {
            $upload_dir = 'views/fotosPropietarios/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); 
            }

            $foto_nombre = basename($_FILES['foto']['name']);
            $foto_ruta = $upload_dir . $nombre . "_" . $apellido . "_" . $foto_nombre;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto_ruta)) {
                $sql = "INSERT INTO propietario (nombre, apellido, cargo, foto) VALUES (:nombre, :apellido, :cargo, :foto)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':apellido', $apellido);
                $stmt->bindParam(':cargo', $cargo);
                $stmt->bindParam(':foto', $foto_ruta);

                if ($stmt->execute()) {
                    echo "<script>
                        alert('Persona ingresada correctamente');
                        window.location.href = 'http://localhost/inventario/?views=usuario/';
                    </script>";
                } else {
                    echo "<script>
                        alert('La persona no se grabó en la base de datos');
                        window.location.href = 'http://localhost/inventario/?views=usuario/';
                    </script>";
                }
            } else {
                echo "<script>
                    alert('No se pudo subir la imagen');
                    window.location.href = 'http://localhost/inventario/?views=usuario/';
                </script>";
            }
        } else {
            echo "<script>
                alert('Archivo no válido o excede el tamaño permitido');
                window.location.href = 'http://localhost/inventario/?views=usuario/';
            </script>";
        }
    } else {
        echo "<script>
            alert('No se ha subido ninguna imagen');
            window.location.href = 'http://localhost/inventario/?views=usuario/';
        </script>";
    }
}
?>

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
$mensajeUpdate = [];

//validaciones
if(!empty($cdula)){
    $sql = "SELECT * FROM propietario WHERE cedula=:cedula";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->execute();
    $cedulaexists = $stmt->fetchColumn();
    if($cedulaexists == 0){
        echo "<script>
        alert('No hay existencias de persona en la base de datos');
        
            window.location.href = 'http://localhost/inventario/?views=inventario/';
    
        </script>";
    }

}


//actualizacion

if(!empty($nombre)){
    $sql = "UPDATE propietario SET nombre = :nombre WHERE cedula =:cedula";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':cedula',$cedula);
    if($stmt-> execute()){
        $msj = "Nombre";
        $mensajeUpdate[]=$msj;
    }else{
        
    }
}


if(!empty($apellido)){
    $sql = "UPDATE propietario SET apellido = :apellido WHERE cedula =:cedula";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(':apellido',$apellido);
    $stmt -> bindParam(':cedula',$cedula);
    if($stmt-> execute()){
        $msj = "Apellido";
        $mensajeUpdate[]=$msj;
    }else{
        
    }
}

if(!empty($cargo)){
    $sql = "UPDATE propietario SET cargo = :cargo WHERE cedula =:cedula";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(':cargo',$cargo);
    $stmt -> bindParam(':cedula',$cedula);
    if($stmt-> execute()){
        $msj = "Cargo";
        $mensajeUpdate[]=$msj;
    }else{
        
    }
}

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto'];
    
    
    $ruta_destino = 'views/fotosPropietarios/' . basename($foto['name']);
    
    // Mover la foto subida al directorio deseado
    if (move_uploaded_file($foto['tmp_name'], $ruta_destino)) {
        // Actualizar la base de datos con la nueva ruta de la foto
        $sql = "UPDATE propietario SET foto = :foto WHERE cedula = :cedula ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':foto', $ruta_destino);
        $stmt->bindParam(':cedula', $cedula);
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
        window.location.href = 'http://localhost/inventario/?views=usuario/';
    </script>";
} else {
    echo"<script>
        alert('No se actualizó ningún campo. $contador');
        window.location.href = 'http://localhost/inventario/?views=usuario/';
    </script>";
}
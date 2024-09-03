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
$id_windows = $_POST['id_windows'];
$windows_licencia = $_POST['windows_licencia'];
$serial = $_POST['serial'];
$cedula = $_POST['cedula'];
$fecha_entrega = $_POST['fecha_entrega'];
$id_estado = $_POST['id_estado'];
$fecha = $_POST['fecha'];
$id_mantenimiento = $_POST['id_mantenimiento'];
$descripcion = $_POST['descripcion'];
$fecha_compra = $_POST['fecha_compra'];
$mensajeUpdate = [];


//-----------------------------------//validaciones de datos//----------------------------------------------------------
if(!empty($id)){
    $sql = "SELECT * FROM equipo WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $idexists = $stmt->fetchColumn();

    if ($idexists == 0) {
        echo "<script>
            alert('No hay existencias de el equipo en la base de datos');
            
                window.location.href = 'http://localhost/inventario/?views=inventario/';
        
        </script>";
    
}
}

// Validar si la licencia de windows existe
if(!empty($windows_licencia)){
    $sql = "SELECT * FROM equipo WHERE windows_licencia = :windows_licencia AND windows_licencia != 'NA' ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':windows_licencia', $windows_licencia);
    $stmt->execute();
    $windExists = $stmt->fetchColumn();

    if ($windExists > 0) {
        echo "<script>
            alert('Licencia windows ya está en uso');
            
                window.location.href = 'http://localhost/inventario/?views=inventario/';
        
        </script>";
    }
}


if(!empty($serial)){
    // Validar serial
    $sql = "SELECT * FROM equipo WHERE serial = :serial AND serial != 'NA'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':serial', $serial);
    $stmt->execute();
    $serialExists = $stmt->fetchColumn();

    if ($serialExists > 0) {
        echo "<script>
        alert('serial ya está en uso');
        
            window.location.href = 'hhttp://localhost/inventario/?views=inventario/';

        </script>";
    }
}

if(!empty($cedula)){
    //validar que no haya registros con la cedula nueva
    $sql = "SELECT * FROM equipo_usuario WHERE  cedula = :cedula";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cedula', $cedulaOld);
    $stmt->execute();
    $propeExistsOld = $stmt->fetchColumn();

    $sql1 = "SELECT * FROM equipo_usuario WHERE cedula = :cedula";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->execute();
    $propeExists = $stmt->fetchColumn();

    if($propeExists > 0 || $propeExistsOld > 0){
        echo "<script>
        alert('persona ya presente en base datos con propietario');
        
            window.location.href = 'http://localhost/inventario/?views=inventario/';

        </script>";
}

}


if(!empty($cedula) && !empty($id)){
    $sql = "SELECT * FROM equipo_usuario WHERE  cedula = :cedula AND id_equipo = :id_equipo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->bindParam(':id_equipo', $id);
    $stmt->execute();
    $campo= $stmt->fetchColumn();

    if($campo > 0){
        echo "<script>
        alert('equipo presente en base datos con propietario');
        
            window.location.href = 'http://localhost/inventario/?views=inventario/';

        </script>";
    }
}





//-------------------------------------------//insercion//-------------------------------------------- 


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
//procesador update

if(!empty($id_procesador)){
    $sql = "UPDATE equipo SET id_procesador = :id_procesador WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':id_procesador', $id_procesador);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="Procesador";
        $mensajeUpdate[] = $msj;
    } else {
        $msj ="Procesador";
        $mensajeNotUpdate[]=$msj;

    }
}

//almacenamiento 
if(!empty($id_almacenamiento)){
    $sql = "UPDATE equipo SET id_almacenamiento = :id_almacenamiento WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':id_almacenamiento', $id_almacenamiento);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="Almacenamiento";
        $mensajeUpdate[] = $msj;
    } else {
        $msj ="Almacenmiento";
        $mensajeNotUpdate[]=$msj;

    }
}

//ram 
if(!empty($id_ram)){
    $sql = "UPDATE equipo SET id_ram = :id_ram WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':id_ram', $id_ram);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj =" Ram";
        $mensajeUpdate[] = $msj;
    } else {
        $msj ="Ram";
        $mensajeNotUpdate[]=$msj;

    }
}

//tarjeta grafica
if(!empty($id_grafica)){
    $sql = "UPDATE equipo SET id_grafica = :id_grafica WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':id_grafica', $id_grafica);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="Grafica";
        $mensajeUpdate[] = $msj;
    } else {
        $msj ="Grafica";
        $mensajeNotUpdate[]=$msj;

    }
}

//office 


//offic
if (!empty($id_windows)) {
    $sql = "UPDATE equipo SET id_windows = :id_windows WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':id_windows', $id_windows);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="Windows";
        $mensajeUpdate[] = $msj;
        
    } else {
        $msj ="Windows";
        $mensajeNotUpdate[]=$msj;
    }
}
//fecha compra
if (!empty($fecha_compra)) {
    $sql = "UPDATE equipo SET fecha_compra = :fecha_compra WHERE id = :id ";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':fecha_compra', $fecha_compra); 
    $stmt->bindParam(':id', $id);
    

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj = "fecha compra";
        $mensajeUpdate[] = $msj;
        
    } else {
        $msj = "fecha entrega";
        $mensajeNotUpdate[] = $msj;
    }
}




//windows
if (!empty($windows_licencia)) {
    $sql = "UPDATE equipo SET windows_licencia = :windows_licencia  WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':windows_licencia', $windows_licencia);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="windows licencia";
        $mensajeUpdate[] = $msj;
    } else {
        $msj ="windows licencia";
        $mensajeNotUpdate[]=$msj;
       
    }
}

if (!empty($serial)) {
    $sql = "UPDATE equipo SET serial = :serial  WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':serial', $serial);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="serial";
        $mensajeUpdate[] = $msj;
    } else {
        $msj ="serial";
        $mensajeNotUpdate[]=$msj;
       
    }
}




//estado 
if(!empty($id_estado)){
    $sql = "UPDATE equipo_usuario SET id_estado = :id_estado WHERE id_equipo = :id_equipo";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':id_estado', $id_estado);
    $stmt->bindParam(':id_equipo', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="estado";
        $mensajeUpdate[] = $msj;
        
    } else {
        $msj ="estado";
        $mensajeNotUpdate[]=$msj;
       
         
    }
}


//foto
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


//fecha de entrega

if (!empty($fecha_entrega)) {
    $sql = "UPDATE equipo_usuario SET fecha_entrega = :fecha_entrega WHERE id_equipo = :id_equipo ";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':fecha_entrega', $fecha_entrega); 
    $stmt->bindParam(':id_equipo', $id);
    

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj = "fecha entrega";
        $mensajeUpdate[] = $msj;
        
    } else {
        $msj = "fecha entrega";
        $mensajeNotUpdate[] = $msj;
    }
} 

//acta entrega
if (isset($_FILES['acta_entrega']) && $_FILES['acta_entrega']['error'] == 0) {
    $acta_nombre = basename($_FILES['acta_entrega']['name']);
    $acta_ruta = $upload_dir . $acta_nombre;
    if (move_uploaded_file($_FILES['acta_entrega']['tmp_name'], $acta_ruta)) {
        $sql = "UPDATE equipo_usuario SET acta_entrega = :acta_entrega WHERE id_equipo = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':acta_entrega', $acta_ruta);
        $stmt->bindParam(':id', $id);
        if($stmt->execute() ){
            
            $msj ="Acta";
            $mensajeUpdate[] = $msj;
        }else{
            echo "<script>
            alert('No se actualizó ningún campo.');
            window.location.href = 'http://localhost/inventario/?views=inventario/';
        </script>";
        }
    }
}


//tabla mantenimiento--------------------------------------------------------------------------------------//
if(!empty($fecha) && !empty($id_mantenimiento) && !empty($descripcion)){
    if (isset($_FILES['foro']) && $_FILES['foro']['error'] == 0){
        $sql = "SELECT * FROM mantenimiento WHERE id_equipo_usuario = :id_equipo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_equipo', $id); 
        $stmt->execute();
        $manExist = $stmt->fetchColumn();
        if($manExist>0){
            $foto = $_FILES['foro'];
            $ruta_destino = 'views/fotosMantenimiento/' . basename($foto['name']);
            if (move_uploaded_file($foto['tmp_name'], $ruta_destino)) {
                $sql = "UPDATE mantenimiento SET fecha=:fecha, tipo_mantenimiento = :id_mantenimmiento, descripcion = :descripcion
                foro = :foto WHERE id_equipo_usuario = :id ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':fecha', $fecha);
                $stmt->bindParam(':id_mantenimmiento', $id_mantenimiento);
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->bindParam(':foto', $ruta_destino);
                $stmt->bindParam(':id', $id);
                if($stmt->execute() ){
                    $msj ="tabla almacenamiento";
                    $mensajeUpdate[] = $msj;
                }else{
                    echo "<script>
                    alert('No se actualizó ningún campo.');
                    window.location.href = 'http://localhost/inventario/?views=inventario/';
                   </script>";
                }
            }   

        }else{
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
            $max_size = 5 * 1024 * 1024;
            if (in_array($_FILES['foro']['type'], $allowed_types) && $_FILES['foro']['size'] <= $max_size) {
                $upload_dir = 'views/fotosMantenimiento/';
        
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true); 
                }
        
                $foto_nombre = basename($_FILES['foro']['name']);
                $foto_ruta = $upload_dir . $foto_nombre;
        
                if (move_uploaded_file($_FILES['foro']['tmp_name'], $foto_ruta)) {
                    $sql = "INSERT INTO mantenimiento (fecha, id_equipo_usuario, tipo_mantenimiento,descripcion,foro) 
                    VALUES (:fecha, :id_equipo, :id_mantenimiento,:descripcion,:foro)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':fecha', $fecha);
                    $stmt->bindParam(':id_equipo', $id);
                    $stmt->bindParam(':id_mantenimiento', $id_mantenimiento);
                    $stmt->bindParam(':descripcion', $descripcion);
                    $stmt->bindParam(':foro', $foto_ruta);
        
                    if ($stmt->execute()) {
                        $msj ="tabla almacenamiento";
                        $mensajeUpdate[] = $msj;
                    } else {
                        echo "<script>
                            alert('Error al ingresar datos de mantenimiento.');
                            window.location.href = 'http://localhost/inventario/?views=dashboard/';
                        </script>";
                    }
        
                }else{
                    echo "<script>
                        alert('Error al mover la imagen');
               
                        window.location.href = 'http://localhost/inventario/?views=dashboard/';
        
                    </script>";
                }
        
            }


            
        }
    }

}
if (!empty($fecha)) {
    $sql = "UPDATE mantenimiento SET fecha = :fecha WHERE id_equipo_usuario = :id_equipo ";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':fecha', $fecha); 
    $stmt->bindParam(':id_equipo', $id);
    

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj = "fecha mantenimiento";
        $mensajeUpdate[] = $msj;
        
    } else {
        $msj = "fecha entrega";
        $mensajeNotUpdate[] = $msj;
    }
} 

if (!empty($id_mantenimiento)) {
    $sql = "UPDATE mantenimiento SET tipo_mantenimiento = :id_mantenimiento WHERE id_equipo_usuario = :id_equipo";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':id_mantenimiento', $id_mantenimiento);
    $stmt->bindParam(':id_equipo', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="Tipo mantenimiento";
        $mensajeUpdate[] = $msj;
        
    } else {
        $msj ="Tipo Mantenimiento";
        $mensajeNotUpdate[]=$msj;
    }
}



if (!empty($descripcion)) {
    $sql = "UPDATE mantenimiento SET descripcion = :descripcion  WHERE id_equipo_usuario = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros correctamente
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':id', $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $msj ="descripcion";
        $mensajeUpdate[] = $msj;
    } else {
        $msj ="descripcion";
        $mensajeNotUpdate[]=$msj;
       
    }
}

if (isset($_FILES['foro']) && $_FILES['foro']['error'] == 0) {
    $foto = $_FILES['foro'];
    
    
    $ruta_destino = 'views/fotosMantenimiento/' . basename($foto['name']);
    
    // Mover la foto subida al directorio deseado
    if (move_uploaded_file($foto['tmp_name'], $ruta_destino)) {
        // Actualizar la base de datos con la nueva ruta de la foto
        $sql = "UPDATE mantenimiento SET foro = :foto WHERE id_equipo_usuario = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':foto', $ruta_destino);
        $stmt->bindParam(':id', $id);
        if($stmt->execute() ){
            
            $msj ="foto mantenimineto";
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



//mostrar campos 
// Mostrar mensaje de los campos actualizados
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

<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
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
$id_mantenimiento=$_POST['id_mantenimiento'];
$descripcion = $_POST['descripcion'];
$fecha_compra = $_POST['fecha_compra'];

//validar que los no hayan valores vacios 

if (empty($id) AND empty($id_modelo) AND empty($id_procesador) AND empty($id_almacenamiento) AND empty($id_ram) 
AND empty($id_grafica) AND empty($id_office) AND empty($id_windows) AND empty($office_licencia) AND empty($windows_licencia) AND
empty($serial) AND empty($cedula) AND empty($fecha) AND empty($id_estado)){

    echo "<script>
        alert('llene todos los datos por favor  ');
           
        window.location.href = 'http://localhost/inventario/?views=dashboard/';
    
    </script>";
}

// Validamos datos para inserción de equipo
// Validación de equipo_id


// Validar si la licencia de windows existe
$sql = "SELECT windows_licencia, COUNT(*) as total
        FROM equipo
        WHERE windows_licencia != 'NA' AND windows_licencia = :windows_licencia
        GROUP BY windows_licencia
        HAVING total > 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':windows_licencia', $windows_licencia);
$stmt->execute();
$windExists = $stmt->fetchColumn();

if ($windExists > 0) {
    echo "<script>
        alert('Licencia windows ya está en uso');
           
            window.location.href = 'http://localhost/inventario/?views=dashboard/';
    
    </script>";
}

// Validar licencia office


// Validar serial
$sql = "SELECT serial, COUNT(*) as total
        FROM equipo
        WHERE serial!= 'NA' AND serial = :serial
        GROUP BY serial
        HAVING total > 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':serial', $serial);
$stmt->execute();
$serialExists = $stmt->fetchColumn();

if ($serialExists > 0) {
    echo "<script>
    alert('serial ya está en uso');
       
        window.location.href = 'http://localhost/inventario/?views=dashboard/';

    </script>";
}

//inserccion a las tablassss

$sql = "SELECT * FROM equipo WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $idexists = $stmt->fetchColumn();
        if ($idexists > 0) {
            $sql = "SELECT * FROM equipo_usuario WHERE id_equipo = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $iddexists = $stmt->fetchColumn();
            if($iddexists > 0){
                echo "<script>
                    alert('el equipo ya se encuentra regitrado');
                    window.location.href = 'http://localhost/inventario/?views=dashboard/';
                    </script>";
            }else{
                if (isset($_FILES['acta_entrega']) && $_FILES['acta_entrega']['error'] == 0) {
                    $allowed_pdf_types = ['application/pdf'];
                    $max_pdf_size = 5 * 1024 * 1024;
            
                    if (in_array($_FILES['acta_entrega']['type'], $allowed_pdf_types) && $_FILES['acta_entrega']['size'] <= $max_pdf_size) {
                        $upload_dir = 'views/actas/';
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0777, true); // Crea la carpeta si no existe
                        }
                        $acta_nombre = basename($_FILES['acta_entrega']['name']);
                        $acta_ruta = $upload_dir . $acta_nombre;
            
                        if (move_uploaded_file($_FILES['acta_entrega']['tmp_name'], $acta_ruta)) {
                            $sql = "INSERT INTO equipo_usuario (cedula, id_equipo, fecha_entrega, id_estado, acta_entrega) 
                                    VALUES (:cedula, :id_equipo, :fecha_entrega, :id_estado, :acta_entrega)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':cedula', $cedula);
                            $stmt->bindParam(':id_equipo', $id);
                            $stmt->bindParam(':fecha_entrega', $fecha_entrega);
                            $stmt->bindParam(':id_estado', $id_estado);
                            $stmt->bindParam(':acta_entrega', $acta_ruta);
                            if ($stmt->execute()) {
                                echo "<script>
                                        alert('Datos ingresados correctamente con PDF.');
                                        window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                    </script>";
                            } else {
                                echo "<script>
                                        alert('Error al ingresar datos en equipo_usuario con PDF.');
                                        window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                    </script>";
                            }
            
                        }else {
                            echo "<script>
                                    alert('Error al mover el archivo PDF.');
                                    window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                </script>";
                        }     
                }else {
                    echo "<script>
                            alert('Archivo PDF no válido.');
                            window.location.href = 'http://localhost/inventario/?views=dashboard/';
                        </script>";
                }
            }else{
                $sql = "INSERT INTO equipo_usuario (cedula, id_equipo, fecha_entrega, id_estado) 
                VALUES (:cedula, :id_equipo, :fecha_entrega, :id_estado)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cedula', $cedula);
                $stmt->bindParam(':id_equipo', $id);
                $stmt->bindParam(':fecha_entrega', $fecha_entrega);
                $stmt->bindParam(':id_estado', $id_estado);

                if ($stmt->execute()) {
                    echo "<script>
                            alert('Datos ingresados correctamente sin PDF.');
                            window.location.href = 'http://localhost/inventario/?views=dashboard/';
                        </script>";
                } else {
                    echo "<script>
                            alert('Error al ingresar datos en equipo_usuario sin PDF.');
                            window.location.href = 'http://localhost/inventario/?views=dashboard/';
                        </script>";
                }
            }
        }

        }else{
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                // Asegurarse de que el archivo sea de tipo imagen y dentro del tamaño permitido
                $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
                $max_size = 5 * 1024 * 1024; // 5MB
            
                if (in_array($_FILES['foto']['type'], $allowed_types) && $_FILES['foto']['size'] <= $max_size) {
                    // Verifica si la carpeta 'fotos' existe, si no, créala
                    $upload_dir = 'views/fotos/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true); // Crea la carpeta si no existe
                    }
            
                    // Mover el archivo a la carpeta 'fotos' en el servidor
                    $foto_nombre = basename($_FILES['foto']['name']);
                    $foto_ruta = $upload_dir . $foto_nombre;
            
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto_ruta)) {
                        // Guardar la ruta de la imagen en la base de datos junto con otros datos
                        $sql = "INSERT INTO equipo (id, id_modelo, serial, id_procesador, id_almacenamiento, id_ram, id_grafica, id_windows, windows_licencia, foto,fecha_compra)
                                VALUES (:id, :id_modelo, :serial, :id_procesador, :id_almacenamiento, :id_ram, :id_grafica, :id_windows, :windows_licencia, :foto,:fecha_compra)";
                        
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id);
                        $stmt->bindParam(':id_modelo', $id_modelo);
                        $stmt->bindParam(':serial', $serial);
                        $stmt->bindParam(':id_procesador', $id_procesador);
                        $stmt->bindParam(':id_almacenamiento', $id_almacenamiento);
                        $stmt->bindParam(':id_ram', $id_ram);
                        $stmt->bindParam(':id_grafica', $id_grafica);
                        $stmt->bindParam(':id_windows', $id_windows);
                        $stmt->bindParam(':windows_licencia', $windows_licencia);
                        $stmt->bindParam(':foto', $foto_ruta);
                        $stmt->bindParam(':fecha_compra', $fecha_compra);
            
            
            
                        if ($stmt->execute()) {
                            // Comprobamos si se subió un PDF
                            if (isset($_FILES['acta_entrega']) && $_FILES['acta_entrega']['error'] == 0) {
                        
                                $allowed_pdf_types = ['application/pdf'];
                                $max_pdf_size = 5 * 1024 * 1024;
                        
                                if (in_array($_FILES['acta_entrega']['type'], $allowed_pdf_types) && $_FILES['acta_entrega']['size'] <= $max_pdf_size) {
                        
                                    $upload_dir = 'views/actas/';
                                    if (!is_dir($upload_dir)) {
                                        mkdir($upload_dir, 0777, true); // Crea la carpeta si no existe
                                    }
                                    $acta_nombre = basename($_FILES['acta_entrega']['name']);
                                    $acta_ruta = $upload_dir . $acta_nombre;
                        
                                    if (move_uploaded_file($_FILES['acta_entrega']['tmp_name'], $acta_ruta)) {
                                        // Inserción de equipo con PDF
                                        $sql = "INSERT INTO equipo_usuario (cedula, id_equipo, fecha_entrega, id_estado, acta_entrega) 
                                                VALUES (:cedula, :id_equipo, :fecha_entrega, :id_estado, :acta_entrega)";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bindParam(':cedula', $cedula);
                                        $stmt->bindParam(':id_equipo', $id);
                                        $stmt->bindParam(':fecha_entrega', $fecha_entrega);
                                        $stmt->bindParam(':id_estado', $id_estado);
                                        $stmt->bindParam(':acta_entrega', $acta_ruta);
                        
                                        if ($stmt->execute()) {
                                            echo "<script>
                                                    alert('Datos ingresados correctamente con PDF.');
                                                    window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                                </script>";
                                        } else {
                                            echo "<script>
                                                    alert('Error al ingresar datos en equipo_usuario con PDF.');
                                                    window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                                </script>";
                                        }
                                    } else {
                                        echo "<script>
                                                alert('Error al mover el archivo PDF.');
                                                window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                            </script>";
                                    }
                                } else {
                                    echo "<script>
                                            alert('Archivo PDF no válido.');
                                            window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                        </script>";
                                }
                            } else {
                                // Inserción de equipo sin PDF
                                $sql = "INSERT INTO equipo_usuario (cedula, id_equipo, fecha_entrega, id_estado) 
                                        VALUES (:cedula, :id_equipo, :fecha_entrega, :id_estado)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':cedula', $cedula);
                                $stmt->bindParam(':id_equipo', $id);
                                $stmt->bindParam(':fecha_entrega', $fecha_entrega);
                                $stmt->bindParam(':id_estado', $id_estado);
                        
                                if ($stmt->execute()) {
                                    echo "<script>
                                            alert('Datos ingresados correctamente sin PDF.');
                                            window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                        </script>";
                                } else {
                                    echo "<script>
                                            alert('Error al ingresar datos en equipo_usuario sin PDF.');
                                            window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                        </script>";
                                }
                            }
                        } else {
                            echo "<script>
                                    alert('Error al guardar los datos del equipo.');
                                    window.location.href = 'http://localhost/inventario/?views=dashboard/';
                                </script>";
                        }
                        
                    } else {
                        echo "<script>
                            alert('Error al mover la imagen');
                   
                            window.location.href = 'http://localhost/inventario/?views=dashboard/';
            
                        </script>";
                    }
                } else {
                   
                    echo "<script>
                        alert('Archivo no válido');
                   
                        window.location.href = 'http://localhost/inventario/?views=dashboard/';
            
                    </script>";
                    
                }
            } else {
               
                echo "<script>
                    alert('No se ha subido ninguna imagen');
                   
                    window.location.href = 'http://localhost/inventario/?views=dashboard/';
            
                </script>";
                
            }
            
        }








//----------------------------------------------------------------------------------------------------------------//
if (isset($_FILES['foro']) && $_FILES['foro']['error'] == 0) {
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
                echo "<script>
                    alert('Inserccion en tabla mantenimiento exitoso');
                    window.location.href = 'http://localhost/inventario/?views=dashboard/';
                </script>";
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

    }else{
        echo "<script>
            alert('Archivo no válido');
       
            window.location.href = 'http://localhost/inventario/?views=dashboard/';

        </script>";
    }

}else{

    echo "<script>
    alert('No se ha subido ninguna imagen');
   
    window.location.href = 'http://localhost/inventario/?views=dashboard/';

    </script>";
}





?>

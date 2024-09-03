<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : null;

if (!($id && $cedula)) {
    echo "No se proporcionó información suficiente para mostrar los detalles.";
} else {
    
}
?>


<div class="main content">
    
        <div class="container pb-6 pt-6">
            <form class ="box"id="registroForm" method="POST" action="<?php echo APP_URL; ?>app/controller/detailsController.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <h1 class="title">Revision</h1>
                <h2 class="subtitle">EQUIPO <?php echo $id?></h2>
                <input type="hidden" name="modulo_usuario" value="registrar">
                <div class="columns">
                    <div class="column">
                        <h5>serie del equipo</h5>
                        <input class="input" value= "<?php echo htmlspecialchars($id); ?>" type="text" name="id" required pattern="^PCAI-\d{1,16}$" readonly>
                    </div>
                    <div class="column">
                        <h5>modelo del equipo:</h5>
                        <?php
                            $sqlmodelo = "SELECT m.nombre FROM modelo m INNER JOIN equipo e ON m.id = e.id_modelo WHERE e.id = :id";
                            $stmt = $conn->prepare($sqlmodelo);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['nombre'] : ''; // Verifica si se encontró un resultado
                        ?>
                        
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                        
                    </div>
                    <div class="column">
                        <h5>marca del equipo:</h5>
                        <?php
                            $sqlmodelo = "SELECT m.nombre FROM marca m INNER JOIN modelo mo ON m.id = mo.id_marca INNER JOIN
                            equipo e ON mo.id = e.id_modelo WHERE e.id = :id";
                            $stmt = $conn->prepare($sqlmodelo);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['nombre'] : ''; // Verifica si se encontró un resultado
                        ?>
                        
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_marca" name="id_marca" readonly>
                        
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <h5>procesador</h5>
                        
                        <?php
                            $sql = "SELECT p.nombre FROM procesador p INNER JOIN equipo e ON p.id = e.id_procesador WHERE e.id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['nombre'] : ''; // Verifica si se encontró un resultado
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                       
                    </div>
                    <div class="column">
                        <h5>almacenamiento del equipo (GB):</h5>
                        <?php
                            $sql = "SELECT a.nombre FROM almacenamiento a INNER JOIN equipo e ON a.id = e.id_almacenamiento WHERE e.id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['nombre'] : ''; // Verifica si se encontró un resultado
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <h5>RAM del equipo:</h5>
                        <?php
                            $sql = "SELECT r.valor FROM ram r INNER JOIN equipo e ON r.id = e.id_ram WHERE e.id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['valor'] : ''; // Verifica si se encontró un resultado
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                    </div>
                    <div class="column">
                        <h5>Tarjeta Grafica del equipo</h5>
                        <?php
                            $sql = "SELECT g.nombre FROM grafica g INNER JOIN equipo e ON g.id = e.id_grafica WHERE e.id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['nombre'] : ''; // Verifica si se encontró un resultado
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        
                        <h5>Licencia Windows</h5>
                         <?php
                            $sql = "SELECT windows_licencia  FROM equipo  WHERE id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['windows_licencia'] : ''; // Verifica si se encontró un resultado
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>                        
                    </div>
                    
                    <div class="column">
                        <h5>Windows del equipo</h5>
                        <?php
                            $sql = "SELECT w.nombre FROM windows w INNER JOIN equipo e ON w.id = e.id_windows WHERE e.id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['nombre'] : ''; // Verifica si se encontró un resultado
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                        
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <h5>Serial equipo:</h5>
                        <?php
                            $sql = "SELECT serial FROM equipo  WHERE id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['serial'] : ''; // Verifica si se encontró un resultado
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-flex is-align-items-center">
                        <div class="image-container">
                            <?php
                                $sql = "SELECT foto FROM propietario WHERE cedula = :cedula";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':cedula', $cedula);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['foto'] : ''; 
                            ?>
                            <img src="http://localhost/inventario/app/controller/<?php echo htmlspecialchars($valor_input); ?>" alt="Imagen del usuario" class="user-image">
                        </div>
                        <div class="user-name ml-4">
                            <h5>Persona encargada del equipo:</h5>
                            <?php
                            $sql = "SELECT p.nombre, p.apellido FROM propietario p INNER JOIN equipo_usuario  e ON  e.cedula = p.cedula  WHERE e.id_equipo = :id AND e.cedula = :cedula";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['nombre']." ".$resultado['apellido'] : ''; 
                            ?>
                            <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                        </div>
                    </div>
                    <div class="column">
                        <div class="control">
                            <h5>Fecha de entrega equipo</h5>
                            <?php
                            $sql = "SELECT fecha_entrega FROM equipo_usuario  WHERE id_equipo = :id AND cedula = :cedula";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['fecha_entrega'] : ''; 
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                        </div>
                    </div>
                </div>                
                <div class="columns">
                    <div class="column">
                        <h5>Estado del equipo</h5>
                        <?php
                            $sql = "SELECT es.estado FROM estado es  INNER JOIN equipo_usuario e ON e.id_estado = es.id WHERE id_equipo = :id AND cedula = :cedula";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['estado'] : ''; 
                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                        <div class="column">
                            <div class="space"></div>
                            <h5>Foto mantenimiento </h5>
                            <div class="imagen">
                                <?php
                                    $sql = "SELECT foro FROM mantenimiento WHERE id_equipo_usuario = :id";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $valor_input = $resultado ? $resultado['foro'] : ''; 
                                    if(!empty($valor_input)){
                                        echo '<img src="http://localhost/inventario/app/controller/'. htmlspecialchars($valor_input) .'" alt="Imagen del equipo" width="112" height="28">';

                                    }else{
                                        echo '<label>Sin imagen para mostrar</label>';

                                    }
                                ?>
                            </div>
                        
                        </div>
                    </div>
                    <div class="column">
                        <span>fecha mantenimiento</span>
                            <?php
                                $sql = "SELECT m.fecha 
                                    FROM mantenimiento m 
                                    INNER JOIN equipo_usuario e 
                                    ON m.id_equipo_usuario = e.id_equipo  
                                    WHERE e.id_equipo = :id AND e.cedula = :cedula";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['fecha'] : ''; 
                            ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                        <div class="space"></div>
                        <div class="column">
                            <h5>Tipo mantenimiento</h5>
                            <?php
                                $sql = "SELECT tm.tipo
                                    FROM tipo_mantenimiento tm 
                                    INNER JOIN mantenimiento m
                                    ON tm.id = m.tipo_mantenimiento
                                    INNER JOIN equipo_usuario e
                                    ON m.id_equipo_usuario = e.id_equipo 
                                    WHERE e.id_equipo = :id AND e.cedula = :cedula";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['tipo'] : ''; 
                            ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" id="id_modelo" name="id_modelo" readonly>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <h5>Descripcion mantenimiento </h5>
                        <?php
                            $sql = "SELECT descripcion FROM mantenimiento WHERE id_equipo_usuario = :id "; 
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $valor_input = $resultado ? $resultado['descripcion'] : ''; 

                        ?>
                        <input class="input" value="<?php echo htmlspecialchars($valor_input); ?>" type="text" name="descripcion" readonly>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                    <h5>Foto equipo</h5>
                        <div class="imagen">
                            <?php
                                $sql = "SELECT foto FROM equipo WHERE id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['foto'] : ''; 
                            ?>
                            <img src="http://localhost/inventario/app/controller/<?php echo htmlspecialchars($valor_input); ?>" alt="Imagen del equipo" width="112" height="28">
                        </div>
                        
                    </div>
                    
                    <div class="column">
                        <div class="control">
                            <h5>Fecha de compra equipo</h5>
                            <?php
                                $sql ="SELECT fecha FROM mantenimiento WHERE id_equipo_usuario = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['fecha'] : ''; 
                            ?>
                            <input class="input" value = "<?php echo htmlspecialchars($valor_input); ?>"type="date" name="fecha_compra" readonly>
                        </div>
                        <div class="space"></div>
                        <div class="column">
                            <h5> Acta Entrega </h5>
                            <div class="file is-small">
                                <?php
                                    $sql = "SELECT acta_entrega 
                                        FROM equipo_usuario  
                                        WHERE id_equipo = :id AND cedula = :cedula";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                    $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $valor_input = $resultado ? $resultado['acta_entrega'] : ''; 
                                    if ($valor_input) {
                                        echo '<a href="http://localhost/inventario/app/controller/' . htmlspecialchars($valor_input) . '" target="_blank">Ver Acta de Entrega</a>';
                                    } else {
                                        echo '<span>No hay acta elegida</span>';
                                    }
                                    
                                   
                                ?>
                                
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </form>
        

            <div class="columns">
                <div class="column">
                    <a href="?views=actualizar&id=<?php echo $id ?>&cedula=<?php echo $cedula?>">
                        <button type="submit" class="button is-info is-rounded">Actualizar</button>
                    </a>
                    
                    <a href="?views=inventario">
                        <button type="submit" class="button is-info is-rounded">Regresar</button>
                    </a>

                    <form action="<?php echo APP_URL; ?>app/controller/EliminarController.php" method="POST" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <input type="hidden" name="cedula" value="<?php echo htmlspecialchars($cedula); ?>">
                        <button type="submit" class="button is-danger is-rounded">Eliminar</button>
                    </form>
                
                </div>
            </div>
        </div>
   
</div>
<style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;

}

.main.content {
    max-width: 900px;
    margin: 0 auto;
    padding: 10px;
    background-color: #f4f4f4;
}

.form-container {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Título */
.title, .subtitle {
    color: #333;
    text-align: center;
    font-weight: 700;
}

/* Inputs */
.input {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    transition: border-color 0.3s ease;
}

.input:focus {
    border-color: #3273dc;
    box-shadow: 0 0 5px rgba(50, 115, 220, 0.3);
    outline: none;
}

/* Select (list box) */
.select {
    position: relative;
    display: inline-block;
    width: 100%;
}

.select select {
    display: block;
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    appearance: none;
    background-size: 12px;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.select select:focus {
    border-color: #3273dc;
    box-shadow: 0 0 5px rgba(50, 115, 220, 0.3);
    outline: none;
}

/* Scroll personalizado para los select */
.select select::-webkit-scrollbar {
    width: 8px;
}

.select select::-webkit-scrollbar-thumb {
    background-color: #3273dc;
    border-radius: 5px;
}

.select select::-webkit-scrollbar-track {
    background-color: #f1f1f1;
    border-radius: 5px;
}

/* Botón de envío */
.button {
    background-color: #3273dc;
    color: white;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #275ba0;
}

/* Botones de archivo */
.file-label {
    border-radius: 7px;
    padding: 8px 15px;
    cursor: pointer;
}

.file-input:hover {
    background-color: #275ba0;
}

/* Columns */
.columns {
    margin-bottom: 1rem;
    padding: 5px;
}

.column {
    padding: 0 10px;
}

/* Responsivo */
@media screen and (max-width: 768px) {
    .columns {
        display: block;
    }

    .column {
        margin-bottom: 15px;
    }
}

/*imagen*/
.is-flex {
    display: flex;
    align-items: center;
}

.image-container {
    flex-shrink: 0; /* Para evitar que la imagen se redimensione */
}

.user-image {
    width: 70px; 
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
}

.ml-4 {
    margin-left: 1rem;
}

.space{
    padding:7px;
}

</style>
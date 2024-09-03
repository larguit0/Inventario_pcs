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
    // Realizar la lógica necesaria con $id y $cedula, como consultas a la base de datos
    echo "No se proporcionó información suficiente para mostrar los detalles.";

    // Aquí puedes añadir cualquier otra lógica que necesites para mostrar los detalles
} else {
    
}
?>


<div class="main content">
    
        <div class="container pb-6 pt-6">
            <form class ="box" id="registroForm" method="POST" action="<?php echo APP_URL; ?>app/controller/actualizarController.php" autocomplete="off" enctype="multipart/form-data">
                <h1 class="title">Actualizar</h1>
                <h2 class="subtitle">EQUIPO <?php echo $id?></h2>
                <input type="hidden" name="modulo_usuario" value="registrar">
                <div class="columns">
                    <div class="column">
                        <h5>serie del equipo</h5>
                        <input class="input" value = "<?php echo htmlspecialchars($id); ?>" placeholder= "<?php echo htmlspecialchars($id); ?>" type="text" name="id"  pattern="^PCAI-\d{1,16}$" >
                    </div>
                    <div class="column">
                        <h5>modelo del equipo:</h5>
                        <div class="select">
                            <?php
                                $sqlmodelo = "SELECT m.nombre FROM modelo m INNER JOIN equipo e ON e.id_modelo =m.id   WHERE e.id = :id";
                                $stmt = $conn->prepare($sqlmodelo);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['nombre'] : ''; 
                            ?>
                            <select class="select-marca" id="id_modelo" name="id_modelo">
                                    <option value ><?php echo $valor_input?></option>
                                    <?php
                                    $sqlmodelo = "SELECT id, nombre FROM modelo ";
                                    $stmtLideres = $conn->query($sqlmodelo);
                                    while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <h5>procesador</h5>
                        
                        <div class="select">
                            <?php
                                $sql = "SELECT p.nombre FROM procesador p INNER JOIN equipo e ON p.id = e.id_procesador WHERE e.id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['nombre'] : ''; 
                            ?>
                            <select class="select-procesador" id="id_procesador" name="id_procesador">
                                <option value = ""><?php echo $valor_input?></option>
                                <?php
                                $sqlprocesador = "SELECT id, nombre FROM procesador ";
                                $stmtLideres = $conn->query($sqlprocesador);
                                while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                }
                                ?>
                            </select>

                        </div>
                       
                    </div>
                    <div class="column">
                        <h5>almacenamiento del equipo (GB):</h5>
                        <div class="select">
                            <?php
                                $sql = "SELECT a.nombre FROM almacenamiento a INNER JOIN equipo e ON a.id = e.id_almacenamiento WHERE e.id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['nombre'] : ''; 
                            ?>
                            <select class="select-almacenamiento" id="id_almacenamiento" name="id_almacenamiento" >
                                <option value = ""><?php echo $valor_input?></option>
                                <?php
                                $sqlalmacenamiento = "SELECT id, nombre FROM almacenamiento ";
                                $stmtLideres = $conn->query($sqlalmacenamiento);
                                while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                }
                                ?>
                            </select>


                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                    <h5>RAM del equipo:</h5>
                        <div class="select">
                            
                            <?php
                                $sql = "SELECT r.valor FROM ram r INNER JOIN equipo e ON r.id = e.id_ram WHERE e.id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['valor'] : ''; 
                            ?>
                            <select class="select-ram" id="id_ram" name="id_ram">
                                <option value =""><?php echo $valor_input ?></option>
                                <?php
                                $sqlram = "SELECT id, valor FROM ram ";
                                $stmtLideres = $conn->query($sqlram);
                                while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['valor'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="column">
                        <h5>Tarjeta Grafica del equipo</h5>
                        <div class="select">
                            <?php
                                $sql = "SELECT g.nombre FROM grafica g INNER JOIN equipo e ON g.id = e.id_grafica WHERE e.id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['nombre'] : ''; 
                            ?>
                            <select class="select-grafica" id="id_grafica" name="id_grafica" >
                                <option value = ""><?php echo $valor_input?></option>
                                <?php
                                $sqlram = "SELECT id, nombre FROM grafica ";
                                $stmtLideres = $conn->query($sqlram);
                                while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                }
                                ?>
                            </select>

                        </div>
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
                            $valor_input = $resultado ? $resultado['windows_licencia'] : ''; 
                        ?>
                        <input class="input" placeholder="<?php echo htmlspecialchars($valor_input); ?>" name="windows_licencia">                        
                    </div>

                    <div class="column">
                        <h5>Windows del equipo</h5>
                        <div class="select">
                            <?php
                                $sql = "SELECT w.id,w.nombre FROM windows w INNER JOIN equipo e ON w.id = e.id_windows WHERE e.id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['nombre'] : ''; 
                            ?>
                            <select class="select-windows" id="id_windows" name="id_windows">
                                <option value =""><?php echo $valor_input?></option>
                                <?php
                                $sqlram = "SELECT id, nombre FROM windows ";
                                $stmtLideres = $conn->query($sqlram);
                                while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
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
                            $valor_input = $resultado ? $resultado['serial'] : ''; 
                        ?>
                        <input class="input" placeholder="<?php echo htmlspecialchars($valor_input); ?>"  name="serial">
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <h5>Persona encargada del equipo:</h5>
                        <div class="select">
                            <?php
                                $sql = "SELECT p.nombre, p.apellido FROM propietario p INNER JOIN equipo_usuario  e ON  e.cedula = p.cedula  WHERE e.id_equipo = :id AND e.cedula = :cedula ORDER BY p.nombre,p.apellido ASC";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['nombre']." ".$resultado['apellido'] : ''; 
                            ?>
                            <select class="select-persona" id="cedula" name="cedula">
                                    <option value = "<?php echo $valor_input ?>"><?php echo $valor_input ?></option>
                                    <?php
                                    $sqlprop = "SELECT cedula, nombre, apellido FROM propietario";
                                    $stmtLideres = $conn->query($sqlprop);
                                    while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row['cedula'] . '">' . $row['nombre'] . ' ' . $row['apellido'] . '</option>';
                                    }
                                    ?>
                            </select>
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
                            <input class="input" type="date" name="fecha_entrega">
                        </div>
                        <div class="colum">
                        <label class ="fecha-guardada">ultima fecha gurdada: <?php echo$valor_input?></label>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <h5>Estado del equipo</h5>
                        <div class="select">
                            <?php
                                $sql = "SELECT es.estado FROM estado es  INNER JOIN equipo_usuario e ON e.id_estado = es.id WHERE id_equipo = :id AND cedula = :cedula";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['estado'] : ''; 
                            ?>
                            <select class="select-estado" id="id_estado" name="id_estado">
                                <option value = ""><?php echo $valor_input?></option>
                                <?php
                                $sqlestado = "SELECT id, estado FROM estado ";
                                $stmtLideres = $conn->query($sqlestado);
                                while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['estado'] . '</option>';
                                }
                                ?>
                            </select>
                            

                        </div>
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

                                    }
                                ?>
                                
                            </div>
                            <h5>Ingrese foto mantenimiento </h5>
                            <div class="file is-small">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="foro" accept=".jpg, .png, .jpeg">
                                    <span class="file-cta">
                                        <span class="file-label">Seleccionar una imagen</span>
                                    </span>
                                </label>
                            </div>

                        
                        </div>
                    </div>
                    <div class="column">
                        <h5>Seleccione fecha mantenimiento</h5>
                            <?php
                                $sql = "SELECT fecha 
                                    FROM mantenimiento 
                                    WHERE id_equipo_usuario = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['fecha'] : ''; 
                            ?>
                            <input class="input" type="date" name="fecha">  
                        <div class="column">
                        <label class ="fecha-guardada">ultima fecha gurdada: <?php echo$valor_input?></label>
                        </div>

                        <h5>Tipo mantenimiento</h5>
                        <div class="colum">
                        <div class="select">
                            <?php
                                $sql = "SELECT tm.tipo
                                    FROM tipo_mantenimiento tm 
                                    INNER JOIN mantenimiento m
                                    ON tm.id = m.tipo_mantenimiento
                                    WHERE m.id_equipo_usuario = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id,);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_input = $resultado ? $resultado['tipo'] : ''; 
                            ?>
                             <select class="select-mantenimiento" id="id_mantenimiento" name="id_mantenimiento">
                                    <option value = ""><?php echo $valor_input?></option>
                                    <?php
                                    $sqlmantenimiento = "SELECT id, tipo FROM tipo_mantenimiento ";
                                    $stmtLideres = $conn->query($sqlmantenimiento);
                                    while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row['id'] . '">' . $row['tipo'] . '</option>';
                                    }
                                    ?>
                            </select>

                            </div>
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
                        <input class="input" placeholder="<?php echo htmlspecialchars($valor_input); ?>" type="text" name="descripcion">
                    </div>
                </div>

                <div class="columns">

                    <div class="column">
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
                        <h5>Imagen: equipo</h5>
                        <div class="file is-small">
                            <label class="file-label">
                            <span class="file-cta">
                                    <span class="file-label">Actualizar imagen</span>
                                </span>
                                <input type="file" name="foto_equipo" accept="image/*" class="file-input">
                            </label>
                        </div>
                    
                        <div class="column">
                            <button type="submit" class="button is-info is-rounded">Actualizar</button>
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
                            <input class="input" type="date" name="fecha_compra">
                        </div>
                        <div class="column">
                        <label class ="fecha-guardada">ultima fecha gurdada: <?php echo$valor_input?></label>
                        </div>
                        <div class="space"></div>
                        <div class="column">
                            <h5>Acta Entrega </h5>
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
                            <div class="file is-small">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="acta_entrega" accept=".pdf">
                                        <span class="file-cta">
                                            <span class="file-label">Seleccionar un archivo (Actualizar)</span>
                                        </span>
                                    </label>
                            </div>

                        </div>
                    </div>


                </div>
                
            </form>
        </div>

        <div class="columns">
            <div class="column">
                <a href="?views=inventario">
                    <button type="submit" class="button is-info is-rounded">Regresar</button>
                </a>
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

.fecha-guardada{
    opacity: 0.2;
}
</style>
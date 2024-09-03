<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
?>

<div class="main content">
    <form class="box" id="registroForm" method="POST" action="<?php echo APP_URL; ?>app/controller/dashboardController.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <h1 class="title">Registro</h1>
        <h2 class="subtitle">Registrar Equipo</h2>
        <input type="hidden" name="modulo_usuario" value="registrar">
        <div class="columns">
            <div class="column">
                <h5>Ingrese serie del equipo</h5>
                <input class="input" placeholder="PCAI-" type="text" name="id" required pattern="^PCAI-\d{1,16}$">
            </div>
            <div class="column">
                <h5>Seleccione modelo del equipo:</h5>
                <div class="select">
                    <select class="select-marca" id="id_modelo" name="id_modelo" required>
                        <option>Seleccione modelo del equipo</option>
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
                <h5>Ingrese el procesador</h5>
                <div class="select">
                    <select class="select-procesador" id="id_procesador" name="id_procesador" required>
                        <option>Seleccione el procesador del equipo</option>
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
                <h5>Seleccione almacenamiento del equipo (GB):</h5>
                <div class="select">
                    <select class="select-almacenamiento" id="id_almacenamiento" name="id_almacenamiento" required>
                        <option>Seleccione almacenamiento del equipo</option>
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
                <h5>Seleccione RAM del equipo:</h5>
                <div class="select">
                    <select class="select-ram" id="id_ram" name="id_ram" required>
                        <option>Seleccione RAM del equipo</option>
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
                <h5>Seleccione Tarjeta Grafica del equipo</h5>
                <div class="select">
                    <select class="select-grafica" id="id_grafica" name="id_grafica" required>
                        <option>Seleccione tarjeta gráfica del equipo</option>
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
                <div class="control">
                    <h5>Licencia Windows</h5>
                    <input class="input" placeholder="XXXXX-XXXXX-XXXXX-XXXXX-XXXXX" type="text" name="windows_licencia" required>
                </div>
            </div>

            <div class="column">
                <h5>Seleccione Windows del equipo</h5>
                <div class="select">
                    <select class="select-windows" id="id_windows" name="id_windows" required>
                        <option>Seleccione Windows del equipo</option>
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
                <input class="input" placeholder="serial pc" type="text" name="serial" required>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <h5>Seleccione la persona encargada del equipo:</h5>
                <div class="select">
                    <select class="select-persona" id="cedula" name="cedula" required>
                        <option>Seleccione encargado del equipo</option>
                        <?php
                        $sqlprop = "SELECT cedula, nombre, apellido FROM propietario ORDER BY nombre,apellido ASC";
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
                    <input class="input" type="date" name="fecha_entrega" >
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <h5>Estado del equipo</h5>
                <div class="select">
                    <select class="select-estado" id="id_estado" name="id_estado" required>
                        <option>Seleccione estado del equipo</option>
                        <?php
                        $sqlestado = "SELECT id, estado FROM estado ";
                        $stmtLideres = $conn->query($sqlestado);
                        while ($row = $stmtLideres->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['id'] . '">' . $row['estado'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="space"></div>
                <div class="column">
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
                <div class="control">
                    <input class="input" type="date" name="fecha">
                </div>
                <div class="space"></div>
                <div class="column">
                    <label>Tipo mantenimiento</label>
                    <div class="select">
                        <select class="select-mantenimiento" id="id_mantenimiento" name="id_mantenimiento">
                            <option>Seleccione tipo mantenimiento</option>
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
                    <h5>Ingrese Descripcion mantenimiento </h5>
                <input class="input" placeholder="descripcion" type="text" name="descripcion" >
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <h5>Ingrese foto del equipo</h5>
                <div class="file is-small">
                    <label class="file-label">
                        <input class="file-input" type="file" name="foto" accept=".jpg, .png, .jpeg">
                        <span class="file-cta">
                            <span class="file-label">Seleccionar una imagen</span>
                        </span>
                    </label>
                </div>
            </div>

            <div class="column">
                <div class="control">
                    <h5>Fecha de compra equipo</h5>
                    <input class="input" type="date" name="fecha_compra" >
                </div>
                <div class="space"></div>
                <div class="column">
                    <h5>Ingrese Acta Entrega </h5>
                    <div class="file is-small">
                        <label class="file-label">
                            <input class="file-input" type="file" name="acta_entrega" accept=".pdf">
                            <span class="file-cta">
                                <span class="file-label">Seleccionar un archivo</span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <div class="columns">
            <div class="column">
                <button type="submit" class="button is-info is-rounded">Guardar</button>
            </div>
        </div>
    </form>
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
    margin-bottom: 2rem;
    padding: 8.5px;
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

.space{
    padding:7px;
}
    
</style>

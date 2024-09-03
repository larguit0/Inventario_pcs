<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestio_equipos", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

// Capturar la búsqueda desde la URL
$busqueda = isset($_GET['search']) ? $_GET['search'] : '';

?>

<div class="main content">
    <section class="buscar-container">
        <!-- Buscador -->
        <div class="buscar-bar">
            <input class="input" type="text" name="busqueda" id="buscar" placeholder="BUSQUE PERSONA DE INTERES" value="<?php echo htmlspecialchars($busqueda); ?>">
            <button onclick="search()" class="button is-info is-rounded">Buscar</button>
        </div>
    </section>

    <section class="result-container">
        <div id="results" class="container">
            <?php
            if ($busqueda) {
                $sql = "SELECT * FROM propietario WHERE nombre LIKE :busqueda OR apellido LIKE :busqueda OR cargo LIKE :busqueda";
                $stmt = $conn->prepare($sql);
                $searchParam = "%".$busqueda."%";
                $stmt->bindParam(':busqueda', $searchParam, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="space">';
                        echo '<div class="equipo-card">';
                            echo '<div class="card-header">';
                                echo '<h4 class="title">Nombre: ' . htmlspecialchars($row['nombre']) . '</h4>';
                            echo '</div>';
                            echo '<div class="card-body">';
                                echo '<form method="POST" action="' . APP_URL . 'app/controller/usuarioDeleteController.php" autocomplete="off">';
                                    echo '<input type="hidden" name="modulo_usuario" value="eliminar">';
                                    echo '<input type="hidden" name="cedula" value="' . htmlspecialchars($row['cedula']) . '">';
                                    echo '<div class="field">';
                                        echo '<label class="label">Foto</label>';
                                        echo '<div class="column is-flex is-align-items-center">';
                                            echo '<div class="image-container">';
                                                echo '<img src="http://localhost/inventario/app/controller/' . htmlspecialchars($row['foto']) . '" class="user-image" alt="Imagen del equipo">';
                                            echo '</div>';
                                            echo '<div class="ml-4"></div>';  // Espacio entre la imagen y el texto
                                            echo '<div class="column">';
                                                echo '<div class="field">';
                                                    echo '<label class="label">Nombre</label>';
                                                    echo '<div class="control">';
                                                        echo '<input class="input is-small" type="text" name="nombre" value="' . htmlspecialchars($row['nombre']) . '" readonly>';
                                                    echo '</div>';
                                                echo '</div>';
                                                echo '<div class="field">';
                                                    echo '<label class="label">Apellido</label>';
                                                    echo '<div class="control">';
                                                        echo '<input class="input is-small" type="text" name="apellido" value="' . htmlspecialchars($row['apellido']) . '" readonly>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>'; // Cierre de la columna con el texto
                                        echo '</div>'; // Cierre de la columna is-flex
                                    echo '</div>'; // Cierre de field para la imagen y nombre
                                    echo '<div class="field">';
                                        echo '<label class="label">Cargo</label>';
                                        echo '<div class="control">';
                                            echo '<input class="input is-small" type="text" name="cargo" value="' . htmlspecialchars($row['cargo']) . '" readonly>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="field">';
                                        echo '<div class="control">';
                                            echo '<button type="submit" class="button is-danger is-small is-rounded">Eliminar</button>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</form>';
                    
                                // Formulario separado para "Actualizar"
                                echo '<a href="?views=actualizar-usuario&cedula=' . urlencode($row['cedula']) . '">';
                                    echo '<button type="button" class="button is-info is-small is-rounded">Actualizar</button>';
                                echo '</a>'; 
                            echo '</div>'; // Cierre del cuerpo de la tarjeta
                        echo '</div>'; // Cierre de la tarjeta del equipo
                    echo '</div>'; // Cierre del espacio
                                }
                } else {
                    echo '<p>No se encontraron resultados para "' . htmlspecialchars($busqueda) . '".</p>';
                }
            }
            ?>
        </div>
    </section>

    <div class="action-container">
        <div class="columns">
            <div class="column">
                <a href="?views=usuario">
                    <button type="button" class="button is-info is-small is-rounded">Regresar</button>
                </a>
            </div>
        </div>
    </div>
</div>

<style>

 body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;

}

.space{
    padding: 3px;
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
.equipo-card {
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 1rem;
    background-color: #f9f9f9;
    border-radius: 8px;
    max-width: 500px;
    margin: 0 auto;
}

.form-container {
    padding: 1rem;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.card-header {
    margin-bottom: 1rem;
}

.card-body {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.field {
    margin-bottom: 0.75rem;
}

.input.is-small {
    font-size: 0.85rem;
    padding: 0.5rem;
}

.button.is-small {
    font-size: 0.85rem;
    padding: 0.5rem 1rem;
}

.button.is-rounded {
    border-radius: 12px;
}

.buscar-bar {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    padding: 10px;
}

.buscar-bar .input {
    max-width: 900px;
}

.action-container {
    margin-top: 2rem;
    text-align: center;
}

.is-flex {
    display: flex;
    align-items: center;
}

.image-container {
    flex-shrink: 0; /* Para evitar que la imagen se redimensione */
}

.user-image {
    width: 80px; 
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}

.ml-4 {
    margin-left: 1rem;
}
</style>

<script>
// Función de búsqueda
function search() {
    var searchValue = document.getElementById('buscar').value;
    if (searchValue) {
        window.location.href = "?views=usuario-Borrar&search=" + encodeURIComponent(searchValue);
    }
}

// Activar búsqueda con Enter
document.getElementById('buscar').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') { 
        search();  
    }
});
</script>

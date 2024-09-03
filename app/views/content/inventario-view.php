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
    <section class="buscar-container">
        <!-- Buscador -->
        <div class="buscar-bar">
            <input class="input" type="text" name="busqueda" id="buscar" placeholder="BUSQUE EQUIPO DE INTERES">
            <button onclick="search()" class="button is-info is-rounded">Buscar</button>
        </div>
    </section>

    <section class="result-container">
        <div id="results" class="container">
            <?php
            
            // Consulta para obtener 12 registros por defecto
            $sql = "SELECT eq.foto,p.cedula ,p.nombre, p.apellido ,eq.id 
                    FROM equipo_usuario eu 
                    JOIN propietario p ON eu.cedula = p.cedula
                    JOIN equipo eq ON eu.id_equipo = eq.id
                    ORDER BY eq.id ASC
                    LIMIT 12 ";
            $stmt = $conn->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                echo '<div class="equipo-card" id="'.$row['id'].'" name = "'.$row['id'].'">';
                echo '<img src="http://localhost/inventario/app/controller/' . $row['foto'] . '" alt="Foto del equipo" width="112" height="28">';
                echo '<p>' . $row['id'] . '</p>';
                echo '<p>' . $row['nombre'] . ' ' . $row['apellido'] . '</p>';
                echo '<div></div>';
                echo '<a href="?views=detalles&id=' . $row['id'] . '&cedula=' . $row['cedula'] . '">';
                echo '<button type="submit" class="button is-info is-rounded">Inspeccionar</button>';
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <section class="action-container">
        <div class="informe-button">
            <!-- Botón para sacar informe -->
            <a href="<?php echo APP_URL; ?>app/controller/reporteController.php" target="_blank">
                <button type="submit" class="button is-info is-rounded">Informe</button>
            </a>
          
            
            <a href="?views=dashboard">
                <button type="submit" class="button is-info is-rounded">Regresar</button>
            </a>
           
        </div>
    </section>
   
</div>

<style>
.container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
  }
  
  .equipo-card {
      border: 1px solid #ddd;
      padding: 1rem;
      text-align: center;
      background-color: #f9f9f9;
      border-radius: 8px;
  }
  
  .equipo-card img {
      display: block;
      margin: 0 auto 0.5rem;
  }
  
  .equipo-card p {
      margin: 0.5rem 0;
  }
  
  .informe-button, .button {
      margin-top: 1em;
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
/* Media Queries para responsividad */
@media screen and (max-width: 1024px) {
    .container {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media screen and (max-width: 768px) {
    .container {
        grid-template-columns: repeat(1, 1fr);
    }

    .buscar-bar {
        flex-direction: column;
        width: 100%;
    }

    .buscar-bar .input {
        max-width: 100%;
        width: 100%;
    }
}

@media screen and (max-width: 480px) {
    .container {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }

    .buscar-bar {
        padding: 5px;
    }

    .equipo-card {
        padding: 0.5rem;
    }
}

</style>

<script>
function search() {
    var searchValue = document.getElementById('buscar').value;
    if (searchValue) {
        window.location.href = "?views=busqueda&search=" + encodeURIComponent(searchValue);
    }
}
document.getElementById('buscar').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {  
        search(); 
    }
});
</script>
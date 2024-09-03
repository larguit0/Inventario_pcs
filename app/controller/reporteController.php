<?php

require_once ("../../config/app.php");
$fecha_actual = date('Y-m-d'); 

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte_{$fecha_actual}.xls");
header("Cache-Control: max-age=0");

?>
<html>
<head>
    <style>
        .header {
            text-align: center;
        }
        .header h1 {
            font-size: 24px;
            margin: 10px 0;
        }
        .header h2 {
            font-size: 18px;
            margin: 0;
        }
        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Reporte Equipos Acema</h1>
    <h2>Fecha: <?php echo $fecha_actual; ?></h2>
</div>

<table>
<thead>    
<tr>
<th>NOMBRE EMPLEADO</th>
<th>APELLIDO EMPLEADO</th>
<th>ID EQUIPO</th>
<th>MARCA</th>
<th>MODELO</th>
<th>SERIAL</th>
<th>ESTADO</th>
<th>PROCESADOR</th>
<th>FECHA ENTREGA</th>
<th>ALMACENAMIENTO(GB)</th>
<th>RAM</th>
<th>GRAFICA</th>
<th>WINDOWS</th>
<th>LICENCIA WINDOWS</th>
<th>FECHA MANTENIMIENTO</th>
<th>DESCRIPCION</th>
<th>TIPO MANTENIMIENTO</th>
</tr>
</thead>
<tbody>

<?php

    $conexion = mysqli_connect("localhost", "root", "", "gestio_equipos");
    mysqli_set_charset($conexion,"utf8");               
    $SQL = "SELECT 
                p.nombre AS nombre_empleado,
                p.apellido AS apellido_empleado,
                e.id AS equipo_id,
                m.nombre AS marca,
                mo.nombre AS modelo,
                e.serial,
                es.estado,
                pr.nombre AS procesador,
                eu.fecha_entrega,
                a.nombre AS almacenamiento,
                r.valor AS ram,
                g.nombre AS grafica,
                w.nombre AS windows,
                e.windows_licencia AS windows_licencia,
                ma.fecha AS fecha_mantenimiento,
                ma.descripcion AS descripcion,
                tm.tipo AS tipo_mantenimiento 
            FROM 
                equipo_usuario eu
            INNER JOIN 
                propietario p ON eu.cedula = p.cedula 
            INNER JOIN 
                equipo e ON e.id = eu.id_equipo 
            INNER JOIN 
                modelo mo ON e.id_modelo = mo.id 
            INNER JOIN 
                marca m ON mo.id_marca = m.id 
            INNER JOIN 
                procesador pr ON pr.id = e.id_procesador 
            INNER JOIN 
                almacenamiento a ON a.id = e.id_almacenamiento 
            INNER JOIN 
                ram r ON r.id = e.id_ram 
            INNER JOIN 
                windows w ON w.id = e.id_windows 
            INNER JOIN 
                grafica g ON g.id = e.id_grafica 
            INNER JOIN 
                estado es ON es.id = eu.id_estado 
            LEFT JOIN 
                mantenimiento ma ON eu.cedula = ma.id_equipo_usuario 
            LEFT JOIN 
                tipo_mantenimiento tm ON ma.tipo_mantenimiento = tm.id
            ORDER BY  e.id ASC";

    $dato = mysqli_query($conexion, $SQL);

    if ($dato && $dato->num_rows > 0) {
        while ($fila = mysqli_fetch_array($dato)) {
?>
<tr>
<td><?php echo $fila['nombre_empleado']; ?></td>
<td><?php echo $fila['apellido_empleado']; ?></td>
<td><?php echo $fila['equipo_id']; ?></td>
<td><?php echo $fila['marca']; ?></td>
<td><?php echo $fila['modelo']; ?></td>
<td><?php echo $fila['serial']; ?></td>
<td><?php echo $fila['estado']; ?></td>
<td><?php echo $fila['procesador']; ?></td>
<td><?php echo $fila['fecha_entrega']; ?></td>
<td><?php echo $fila['almacenamiento']; ?></td>
<td><?php echo $fila['ram']; ?></td>
<td><?php echo $fila['grafica']; ?></td>
<td><?php echo $fila['windows']; ?></td>
<td><?php echo $fila['windows_licencia']; ?></td>
<td><?php echo $fila['fecha_mantenimiento']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['tipo_mantenimiento']; ?></td>
</tr>
<?php
        }
    } else {
        echo "<tr><td colspan='18'>No se encontraron datos</td></tr>";
    }
?>
</tbody>
</table>
</body>
</html>

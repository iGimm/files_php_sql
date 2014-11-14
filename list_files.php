<!-- III: Listar los archivos existentes en el servidor -->
<?php
    $dbLink = new mysqli('localhost', 'root', 'root', 'agenda'); // Hacer la conexión a la base de datos.

    if(mysqli_connect_errno()) {
        die("Error en la conexion a la base de datos: ".mysqli_connect_error());
    }
     
    $sql    = 'SELECT `id`, `name`, `mime`, `size`, `created` FROM `archivos`'; // Query para obtener la lista con los archivos existentes
    $result = $dbLink->query($sql);
     
    if($result) {                                                // Revisar que haya sido exitosa la carga
        if($result->num_rows == 0) {                             // Revisar si hay archivos o si está vacía la tabla
            echo '<p>No hay archivos en la base de datos.</p>';
        
        } else {                                                 // Imprimir el encabezado de la tabla
            echo '<table width="100%">
                    <tr>
                        <td><b>Archivo</b></td>
                        <td><b>Mime</b></td>
                        <td><b>Tama&ntilde;o (bytes)</b></td>
                        <td><b>Creado</b></td>
                        <td><b>&nbsp;</b></td>
                    </tr>';
     
            while($row = $result->fetch_assoc()) {               // Imprimir cada archivo encontrado en una fila de la tabla
                echo "
                    <tr>
                        <td>{$row['name']}</td>
                        <td>{$row['mime']}</td>
                        <td>{$row['size']}</td>
                        <td>{$row['created']}</td>
                        <td><a href='get_file.php?id={$row['id']}'>Download</a></td>
                    </tr>";
            }
            echo '</table>';                                     // Final de la tabla
        }
        $result->free();                                         // Liberar la variable resul para obtener el siguiente dato

    } else {
        echo 'Error! SQL query failed:';
        echo "<pre>{$dbLink->error}</pre>";
    }
    $dbLink->close();                                            // Cerrar la conexión mysql
?>
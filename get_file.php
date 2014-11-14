<!-- II:I -->
<?php
if(isset($_GET['id'])) {                                  // Verificar que se tiene un ID

    $id = intval($_GET['id']);                            // Obtener el ID en una variable para poder usarlo
 
    if($id <= 0) {                                        // Verificar que el ID sea válido
        die('El ID es inv&aacute;lido!');
    
    } else {
        $dbLink = new mysqli('localhost', 'root', 'root', 'agenda');// Conectar a la base de Datos

        if(mysqli_connect_errno()) {
            die("Fall&oacute; la conexi&oacute;n: ". mysqli_connect_error());
        }
 
        $query =                                          // Traer ('fetch') la información del archivo a la variable result
           "SELECT `mime`, `name`, `size`, `data`
            FROM `archivos`
            WHERE `id` = {$id}";
        $result = $dbLink->query($query);
 
        if($result) {                                     // Verificar que result sea válido
            if($result->num_rows == 1) {
                $row = mysqli_fetch_assoc($result);       // Obtener la fila del registro
 
                header("Content-Type: ". $row['mime']);   // Imprimir encabezados
                header("Content-Length: ". $row['size']); // Imprimir encabezados
                header("Content-Disposition: attachment; filename=". $row['name']); // Imprimir encabezados
 
                echo $row['data'];                        // Imprimir los datos
            
            } else {
                echo 'Error! No image exists with that ID.';
            }

            @mysqli_free_result($result);                 // Liberar los recursos de mysqli
        
        } else {
            echo "Error en el Query: <pre>{$dbLink->error}</pre>";
        }
        @mysqli_close($dbLink);
    }

} else {
    echo 'Error! No se recibi&oacute; ning&uacute;n ID.';
}
?>
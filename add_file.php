<!-- II: Agregar el archivo a la base de datos -->
<?php
    if(isset($_FILES['uploaded_file'])) {                                // Verificar que un archivo ha sido subido
        if($_FILES['uploaded_file']['error'] == 0) {                     // Asegura que el archivo fue enviado sin errores al servidor
            
            $dbLink = new mysqli('localhost', 'root', 'root', 'agenda'); // Conectar a la base de datos
            if(mysqli_connect_errno()) {
                die("MySQL connection failed: ". mysqli_connect_error());
            }
     
            $name = $dbLink->real_escape_string($_FILES['uploaded_file']['name']);  // Datos del archivo
            $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);  // Datos del archivo
            $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name'])); // Datos del archivo
            $size = intval($_FILES['uploaded_file']['size']);               // Datos del archivo
     
            // SQL Query
            $query = " INSERT INTO archivos ( name, mime, size, data, created) VALUES ('{$name}', '{$mime}', {$size}, '{$data}', NOW())";
            $result = $dbLink->query($query);                            // Result ejecuta el Query

            if($result) {                                                // Revisar si result insertó el archivo
                echo '¡Tu archivo se ha adjuntado exitosamente!';
            
            } else {
                echo 'Error! No se pudo insertar el archivo.'
                   . "<pre>{$dbLink->error}</pre>";
            }
        
        } else {
            echo 'Ocurrio un error mientras se cargaba el archivo.'. 'C&oacute;digo del error: '. intval($_FILES['uploaded_file']['error']);
        }

        $dbLink->close();                                                 // Cerrar la conexión a la base de datos

    } else {
        echo 'Error! El archivo no fue enviado!';
    }
    echo '<p>Click <a href="index.html">aqu&iacute;</a> para regresar.</p>'; //Link para regresar a la página de "upload"
?>
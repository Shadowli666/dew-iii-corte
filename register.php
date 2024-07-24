<?php
// Datos de la conexión
require_once("conn.php");
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario que se envia a través de POST
$nombre = $_POST['nombre'];
$email = $_POST['email'];

// Preparar la consulta SQL para insertar los datos
/**
 * Este método vincula los valores reales a los marcadores de posición en la declaración preparada.
 * Tipos de datos: El primer argumento de bind_param es una 
 * que especifica los tipos de los valores que se van a vincular:
 *   - s para string (cadena de texto)
 *   - i para integer (entero)
 *   - d para double (número de punto flotante)
 *   - b para blob (dato binario)
 * En este caso, "ss" indica que ambos parámetros son cadenas de texto.
 * Los siguientes argumentos ($nombre y $email) son los valores que se asignarán
 *  a los marcadores de posición en la declaración SQL.
 */
$sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ss", $nombre, $email);

    // Bindear los parámetros y ejecutar la consulta
    $stmt->bind_param("ss", $nombre, $email);
    if ($stmt->execute()) {
        echo "<div class='container mt-5'><div class='alert alert-success' role='alert'>Registro exitoso</div></div>";
    } else {
        echo "<div class='container mt-5'><div class='alert alert-danger' role='alert'>Error en el registro: " . $stmt->error . "</div></div>";
    }
    
    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
    ?>
    
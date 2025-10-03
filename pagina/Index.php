<?php
// Datos de conexión a MySQL
$servername = "localhost";   // Servidor
$username   = "root";        // Usuario de MySQL (XAMPP normalmente 'root')
$password   = "";            // Contraseña (XAMPP normalmente vacía)
$database   = "EasyGo";      // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre     = $_POST['nombre'];
$correo     = $_POST['correo'];
$telefono   = $_POST['telefono'];
$comentario = $_POST['comentario'];

// Preparar la consulta (evita problemas con comillas)
$stmt = $conn->prepare("INSERT INTO Form (nombre, correo, telefono, comentario) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $correo, $telefono, $comentario);

// Ejecutar y verificar
if ($stmt->execute()) {
    echo "<h2> Registro guardado correctamente</h2>";
    echo "<a href='index.html'>Volver</a>"; // Cambia 'index.html' por tu página principal
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
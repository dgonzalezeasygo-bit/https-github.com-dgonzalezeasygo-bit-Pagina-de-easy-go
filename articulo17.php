<?php
// Datos de conexión a MySQL
$servername = "localhost";   // Servidor
$username   = "root";        // Usuario de MySQL (XAMPP normalmente 'root')
$password   = "";            // Contraseña (XAMPP normalmente vacía)
$database   = "Easy Go";      // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombrecompleto     = $_POST['nombre'];
$correoelectronico     = $_POST['correo'];
$numerodetelefono   = $_POST['telefono'];
$empresaparalaquelaboras = $_POST['empresa'];
$mensaje = $_POST['comentario'];

// Preparar la consulta (evita problemas con comillas)
$stmt = $conn->prepare("INSERT INTO Form (nombre completo, correo electronico, numero de telefono, empresa para la que laboras, mensaje) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombrecompleto, $correoelectronico, $numerodetelefono, $empresaparalaquelaboras, $mensaje);

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
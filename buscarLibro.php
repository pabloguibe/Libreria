<?php
// Crear conexión
$con = mysqli_connect('localhost', 'root', '', 'libros_bd');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Libro</title>
</head>
<body>

<?php
$buscar = $_POST["libro"];
?>

<form method="post" action="buscarLibro.php">
    <label for="libro">Buscar:</label>
    <input type="text" id="libro" name="libro">
    <button type="submit">Buscar</button>
</form>

<?php


$sql = "SELECT * FROM catalogo_libros WHERE titulo LIKE ?";
$stmt = mysqli_prepare($conn, $sql);
$buscar_param = "%" . $buscar . "%";
mysqli_stmt_bind_param($stmt, "s", $buscar_param);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {
    // Salida de datos de cada fila
    while($fila = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $fila["id"]. " titulo : " . $fila["titulo"]. "<br>";
    }
} else {
    echo "0 resultados";
}
mysqli_close($conn);
?>

</body>
</html>
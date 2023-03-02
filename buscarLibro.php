<?php
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
<form method="post">
  <label for="titulo_libro">Titulo del libro a buscar:</label>
  <input type="text" name="titulo_libro" id="titulo_libro">
  <button type="submit">Buscar Libro</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conexion = mysqli_connect('localhost', 'root', '', 'libros_bd');
  if (mysqli_connect_errno()) {
    echo 'Error de conexión a la base de datos: ' . mysqli_connect_error();
    exit;
  }
  $titulo_libro = mysqli_real_escape_string($conexion, $_POST['titulo_libro']);
  $consulta = "SELECT * FROM catalogo_libros WHERE titulo = '$titulo_libro'";
  $resultado = mysqli_query($conexion, $consulta);
  if (mysqli_num_rows($resultado) > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "titulo: " . $row["titulo"] . "<br>";
        echo "autor: " . $row["autor"] . "<br>";
        echo "editorial: " . $row["editorial"] . "<br>";
        echo "genero: " . $row["genero"] . "<br>";
        echo "fecha_publicacion: " . $row["fecha_publicacion"] . "<br>";
        echo "precio: " . $row["precio"] . "<br>";
        echo "<br>";
    }
  } else {
    echo 'El libro no se encuentra en la base de datos.';
  }
  mysqli_close($conexion);
}
?>
<a href="index.php"><button>MENÚ PRINCIPAL</button></a>
</body>
</html>
<?php
$con = mysqli_connect('localhost', 'root', '', 'libros_bd');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Libro</title>
</head>

<body>
<h1>Libros de la libreria</h1>
        <br>

        <table border="1" align="center">
            <tr>
                <td>ID</td>
                <td>TITULO</td>
                <td>AUTOR</td>
                <td>EDITORIAL</td>
                <td>GENERO</td>
                <td>FECHA PUBLICACION</td>
                <td>PRECIO</td>
                <td>IMAGEN</td>
                <td>DESCRIPCION</td>
            </tr>

            <?php
            $sql = "SELECT * from catalogo_libros";
            $result = mysqli_query($con, $sql);

            while ($mostrar = mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <td><?php echo $mostrar['id'] ?></td>
                    <td><?php echo $mostrar['titulo'] ?></td>
                    <td><?php echo $mostrar['autor'] ?></td>
                    <td><?php echo $mostrar['editorial'] ?></td>
                    <td><?php echo $mostrar['genero'] ?></td>
                    <td><?php echo $mostrar['fecha_publicacion'] ?></td>
                    <td><?php echo $mostrar['precio'] ?></td>
                    <td><?php echo $mostrar['imagen'] ?></td>
                    <td><?php echo $mostrar['descripcion'] ?></td>
                    
                </tr>
                <?php
            }
            ?>
        </table> 
<form method="post">
  <label for="titulo_libro">Titulo del libro a eliminar:</label>
  <input type="text" name="titulo_libro" id="titulo_libro">
  <button type="submit">Eliminar libro</button>
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
    $consulta = "DELETE FROM catalogo_libros WHERE titulo = '$titulo_libro'";
    mysqli_query($conexion, $consulta);
    echo 'El libro ha sido eliminado.';
  } else {
    echo 'El libro no se encuentra en la base de datos.';
  }
  mysqli_close($conexion);
}
?>

<a href="index.php"><button>MENÚ PRINCIPAL</button></a>
</body>

</html>
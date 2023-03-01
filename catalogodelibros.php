<?php
$con = mysqli_connect('localhost', 'root', '', 'libros_bd');
?>


<!DOCTYPE html>
<html>
    <head>
        <title>MOSTRAR Libros</title>
        
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
        <a href="index.php"><button>MENÚ PRINCIPAL</button></a>
    </body>
</html>
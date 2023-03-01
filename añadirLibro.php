<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Libro</title>
</head>

<body>
    <form action="añadirLibro.php" method="post" enctype="multipart/form-data">
        <?php
        $valido = true;
        $precioErr = $imagenErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //VALIDAR PRECIO

            if (empty($_POST["precio"])) {
                $precioErr = "Precio obligatorio";
                $valido = false;
            } else if (!is_numeric($_POST["precio"])) {
                $precioErr = "Precio debe ser numerico";
                $valido = false;
            } else if ($_POST["precio"] <= 0) {
                $precioErr = "El precio debe ser positivo";
                $valido = false;
            } else {
                $precio = $_POST["precio"];
            } //Fin Precio

            //VALIDACIÓN FOTO

            $tipo_imagen = $_FILES['imagen']['type'];
            $tamanio_imagen = $_FILES['imagen']['size'];

            if ($_FILES['imagen']['tmp_name'] != "") {

                if (!(strpos($tipo_imagen, "jpeg") || strpos($tipo_imagen, "png") || strpos($tipo_imagen, "jpg"))) {

                    $imagenErr = "Debes introducir una imagen con el siguiente formato:  (extensión .jpeg, .jpg, .png)";
                    $valido = false;
                } else if ($tamanio_imagen > 1000000) {

                    $imagenErr = "La imagen debe tener un tamaño menor a 100kb";
                    $valido = false;
                }
            } //Fin Foto

            //VALIDAR $valido

            if ($valido == false) {
                $error_datos = "No se ha podido enviar el formulario, complete los campos solicitados.";
            }
        } //Fin $Valido
        ?>
        <label>Titulo:</label>
        <input type="text" name="titulo" id="titulo">
        <br>
        <br>

        <label>Autor:</label>
        <input type="text" name="autor" id="autor">
        <br>
        <br>

        <label>Editorial:</label>
        <input type="text" name="editorial" id="editorial">

        <label>Fecha_Publicacion:</label>
        <input type="date" name="fecha_publicacion" id="fecha_publicacion">

        <label>Genero:</label>
        <select name="genero" id="genero">
            <option value="misterio" id="misterio">Misterio</option>
            <option value="terror" id="terror">Terror</option>
            <option value="comedia" id="comedia">Comedia</option>
        </select>

        <label>Precio:</label>
        <input type="number" name="precio" id="precio"> €
        <span class="error"><?php echo $precioErr; ?></span>
        <br>
        <br>

        <label>Imagen:</label>
        <input type="file" name="imagen" id="imagen" />
        <span class="error"><?php echo $imagenErr; ?></span>
        <br>
        <br>

        <label>descripcion:</label>
        <br>
        <textarea id="descripcion" name="descripcion" rows="5" cols="50"></textarea>
        <br>
        <br>
        <input type="submit" name="submit" value="Insertar libro" />
        <input type="reset" name="reset" value="Vaciar Campos" />

        <?php
        if ($valido == true) {
            if (isset($_POST['titulo'])) {
                $titulo = $_POST['titulo'];

                $autor = $_POST['autor'];

                $editorial = $_POST["editorial"];

                $fecha_publicacion = $_POST["fecha_publicacion"];

                $genero = $_POST["genero"];

                $precio = $_POST["precio"];

                if ($_FILES['imagen']['tmp_name'] != "") {

                    copy($_FILES['imagen']['tmp_name'], "images/" . basename($_FILES['imagen']['name']));
                    $nom = $_FILES['imagen']['name'];
                    $imagen = "images/" . basename($_FILES['imagen']['name']);
                    $link = "<li>Imagen: <a href= 'images/$nom' target = '_blank'>$nom</a></li></br>";
                } else {

                    $link = "<li>Imagen: Sin Imagen</li></br>";
                }


                $descripcion = $_POST['descripcion'];

                //ENVIAR DATOS A LA BASE DE DATOS

                if ($valido == true) {

                    $con = mysqli_connect("localhost", "root", "", "libros_bd");
                    $INSERT = "INSERT INTO `catalogo_libros`(`titulo`, `autor`, `editorial`, `genero`, `fecha_publicacion`, `precio`, `imagen`,`descripcion`) VALUES ('" . $titulo . "','" . $autor . "','" . $editorial . "','" . $fecha_publicacion . "','" . $genero . "','" . $precio . "','" . $imagen . "','" . $descripcion . "')";

                    if (mysqli_connect_errno()) {
                        echo "Failed to connect MYSQL:" . mysqli_connect_error();
                        exit;
                    } else {
                        mysqli_query($con, $INSERT);
                    }
                    mysqli_close($con);
                }
        ?>

                <?php
                print("<UL></br>");
                print "<li>Tipo de vivienda: $titulo</li></br>";
                print "<li>Zona: $autor</li></br>";
                print "<li>Dirección: $editorial</li></br>";
                print "<li>Número de dormitorios: $fecha_publicacion</li></br>";
                print "<li>Precio: $genero</li></br>";
                print "<li>Tamaño: $precio</li></br>";
                print $link;
                print "<li>Observaciones: $descripcion</li></br>";
                print("<UL></br>");
                ?>
                <a href="formulario.php"> <button type="submit" name="Insertar_vivienda">Insertar otra vivienda</button></a>

        <?php
            }
        }
        ?>
    </form>
    <a href="index.php"><button>MENÚ PRINCIPAL</button></a>
</body>

</html>
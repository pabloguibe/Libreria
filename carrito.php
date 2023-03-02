<?php
/*
* Este archio muestra los productos en una tabla.
*/
session_start();
include "conection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Carrito</h1>
			<a href="productos.php" class="btn btn-default">Productos</a>
			<br><br>
<?php
/*
* Esta es la consula para obtener todos los productos de la base de datos.
*/
$products = $con->query("select * from product");
if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])):
?>
<table class="table table-bordered">
<thead>
	<th>Cantidad</th>
	<th>Titulo</th>
	<th>Autor</th>
	<th>Editorial</th>
	<th>Genero</th>
	<th>Fecha_Publicacion</th>
	<th>Precio</th>
	<th></th>
</thead>
<?php 
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/
foreach($_SESSION["cart"] as $c):
$catalogo_libros = $con->query("select * from catalogo_libros where id=$c[catalogo_libros_id]");
$r = $catalogo_libros->fetch_object();
	?>
<tr>
<th><?php echo $c["q"];?></th>
	<td><?php echo $r->titulo;?></td>
	<td> <?php echo $r->autor; ?></td>
	<td> <?php echo $r->editorial; ?></td>
	<td> <?php echo $r->genero; ?></td>
	<td> <?php echo $r->fecha_publicacion; ?></td>
	<td> <?php echo $c["q"]*$r->precio; ?></td>
	<td style="width:260px;">
	<?php
	$found = false;
	foreach ($_SESSION["cart"] as $c) { if($c["catalogo_libros_id"]==$r->id){ $found=true; break; }}
	?>
		<a href="eliminarCarrito.php?id=<?php echo $c["catalogo_libros_id"];?>" class="btn btn-danger">Eliminar</a>
	</td>
</tr>
<?php endforeach; ?>
</table>

<form class="form-horizontal" method="post" action="procesarCarrito.php">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email del cliente</label>
    <div class="col-sm-5">
      <input type="email" name="email" required class="form-control" id="inputEmail3" placeholder="Email del cliente">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Procesar Venta</button>
    </div>
  </div>
</form>


<?php else:?>
	<p class="alert alert-warning">El carrito esta vacio.</p>
<?php endif;?>

		</div>
	</div>
</div>
<a href="index.php"><button>MENÚ PRINCIPAL</button></a>
</body>
</html>
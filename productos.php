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
			<h1>Productos</h1>
			<a href="carrito.php" class="btn btn-warning">Ver Carrito</a>
			<a href="index.php" class="btn btn-warning">Cancelar</a>
			<br><br>
<?php
/*
* Esta es la consula para obtener todos los productos de la base de datos.
*/
$catalogo_libros = $con->query("select * from catalogo_libros");
?>
<table class="table table-bordered">
<thead>
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
while($r=$catalogo_libros->fetch_object()):?>
<tr>
	<td><?php echo $r->titulo;?></td>
	<td> <?php echo $r->autor; ?></td>
	<td> <?php echo $r->editorial; ?></td>
	<td> <?php echo $r->genero; ?></td>
	<td> <?php echo $r->fecha_publicacion; ?></td>
	<td> <?php echo $r->precio; ?></td>
	<td style="width:260px;">
	<?php
	$found = false;

	if(isset($_SESSION["cart"])){ foreach ($_SESSION["cart"] as $c) { if($c["catalogo_libros_id"]==$r->id){ $found=true; break; }}}
	?>
	<?php if($found):?>
		<a href="carrito.php" class="btn btn-info">Agregado</a>
	<?php else:?>
	<form class="form-inline" method="post" action="addCarrito.php">
	<input type="hidden" name="catalogo_libros_id" value="<?php echo $r->id; ?>">
	  <div class="form-group">
	    <input type="number" name="q" value="1" style="width:100px;" min="1" class="form-control" placeholder="Cantidad">
	  </div>
	  <button type="submit" class="btn btn-primary">Agregar al carrito</button>
	</form>	
	<?php endif; ?>
	</td>
</tr>
<?php endwhile; ?>
</table>

		</div>
	</div>
</div>
</body>
</html>
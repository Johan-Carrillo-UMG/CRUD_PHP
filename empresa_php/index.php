<?php
	require_once 'conexion.php';
	
	//EMPLEADOS
	$db_conexionE = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre);
	$db_conexionE ->real_query("SELECT e.id_empleado as id, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono, e.fecha_nacimiento, p.puesto FROM db_empresa_2021.empleados AS e INNER JOIN db_empresa_2021.puestos AS p ON e.id_puesto = p.id_puesto ORDER BY codigo;");
	$resultadoE = $db_conexionE->use_result();

	//PUESTOS
	$db_conexionP = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre);
	$db_conexionP ->real_query("SELECT id_puesto as id, puesto as puesto FROM puestos;");
	$resultadoP = $db_conexionP->use_result();
?>

<!doctype html>
<html lang="en">
  <head>
	<title>Pagina PHP</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
	  	<br>
	  	<h1 class="text-center"> Formulario Empleados </h1>

	  <div class="container">
		  <form class="d-flex" action="nuevo.php" method="POST">
			  <div class="col">
				  
			  	<div class="mb-3">
					<label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
					<input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="E001" required>
				</div>

				<div class="mb-3">
					<label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
					<input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombre1 Nombre2" required>
				</div>

				<div class="mb-3">
					<label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
					<input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellido1 Apellido2" required>
				</div>

				<div class="mb-3">
					<label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
					<input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Calle/Avenida/Lugar #Casa" required>
				</div>

				<div class="mb-3">
					<label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
					<input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="12345678" required>
				</div>

				<div class="mb-3">
				  <label for="lbl_puesto" class="form-label"><b>Puesto</b></label>
				  <select class="form-select" name="drop_puesto" id="drop_puesto" required>
					<option value=0>--- Puestos ---</option>
					
					<?php
						while($filaPuesto = $resultadoP->fetch_assoc()){
							echo"<option value=". $filaPuesto['id'] .">". $filaPuesto['puesto'] ."</option>";
						}
						$db_conexionP->close();
					?>

				  </select>
				</div>

				<div class="mb-3">
					<label for="lbl_fn" class="form-label"><b>Fecha de Nacimiento</b></label>
					<input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="dd/mm/aaaa" required>
				</div>
				


				<div class="mb-3">
					<input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
				</div>



			  </div>
		  </form>
		
		  <br>

		  <table class="table table-striped table-inverse table-responsive">
			  <thead class="thead-inverse">
				  <tr>
					  <th>Codigo</th>
					  <th>Nombres</th>
					  <th>Apellidos</th>
					  <th>Direccion</th>
					  <th>Telefono</th>
					  <th>Nacimiento</th>
					  <th>Puesto</th>
				  </tr>
				  </thead>
				  <tbody>
				    
					<?php
						while($filaEmpleado = $resultadoE->fetch_assoc()){
							echo "<tr data-id=". $filaEmpleado['id'] .">";
								echo"<td>". $filaEmpleado['codigo'] ."</td>";
								echo"<td>". $filaEmpleado['nombres'] ."</td>";
								echo"<td>". $filaEmpleado['apellidos'] ."</td>";
								echo"<td>". $filaEmpleado['direccion'] ."</td>";
								echo"<td>". $filaEmpleado['telefono'] ."</td>";
								echo"<td>". $filaEmpleado['fecha_nacimiento'] ."</td>";
								echo"<td>". $filaEmpleado['puesto'] ."</td>";
								echo"<td><a href='editar.php?id=".$filaEmpleado['id']."' class='btn btn-warning'>Editar</a></td>";
								echo"<td><a href='eliminar.php?id=".$filaEmpleado['id']."' class='btn btn-danger'>Eliminar</a></td>";
								
							echo"</tr>";
						}
						$db_conexionE->close();
					?>
				  </tbody>
		  </table>

	  </div>						

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>

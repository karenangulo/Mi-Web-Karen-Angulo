<?php 
 require_once 'Metodos.php'; //incluimos la clase metodo para que sea referida y poder utilizarla.
 require_once 'Entidad.php'; //incluimos la clase Entidad para que sea referida y poder utilizarla.
 $obj = new Metodos(); //creamos una instancia de la clase metodos para acceder a todos los metodo contenidos en la clase. 
 $entidad = new Datos(); // creamos una instancia de la clase Datos, clase referida como Entidad.php
 if (isset($_GET['id'])) { //valida si exite $_GET['id'] es por que vamos a editar un campo de la lista.

 	$entidad = $obj->ObtenerRegistro($_GET['id']); //obtiene la informacion en base al parametro Identificador.
 }

 if (isset($_POST['Identificador']) && $_POST['Identificador']!="") { // validamos si existe Identificador es por que vamo a realizar una edicion de informacion.

 	        
 	        $entidad->__SET('Identificador',          $_REQUEST['Identificador']);
	        $entidad->__SET('Nombre_Proyecto',          $_REQUEST['Nombre_Proyecto']);
	        $entidad->__SET('Autores',          $_REQUEST['Autores']);
	        $entidad->__SET('Nombre_Asesor',        $_REQUEST['Nombre_Asesor']);
	        $entidad->__SET('Fecha_Ingreso',            $_REQUEST['Fecha_Ingreso']);
	        $entidad->__SET('Nota', $_REQUEST['Nota']);
	        $entidad->__SET('Linea_Investigacion', $_REQUEST['Linea_Investigacion']);

	        $resultado=$obj->Editar($entidad);

	        if ($resultado>0) {
	        	 header('Location: index.php?ms=si');
	        	
	        }
	        else
	        {
	        	header('Location: index.php?ms=no');
	        }
 	

 }else
 {
 	  if (isset($_POST['Nombre_Proyecto'])) { //validamos si existe el campo Nombre_Proyecto, ese o cualquier otro que no sea Identificador es por que vamos a insertar un nuevo registro.

	 	   	
	        $entidad->__SET('Nombre_Proyecto',          $_REQUEST['Nombre_Proyecto']);
	        $entidad->__SET('Autores',          $_REQUEST['Autores']);
	        $entidad->__SET('Nombre_Asesor',        $_REQUEST['Nombre_Asesor']);
	        $entidad->__SET('Fecha_Ingreso',            $_REQUEST['Fecha_Ingreso']);
	        $entidad->__SET('Nota', $_REQUEST['Nota']);
	        $entidad->__SET('Linea_Investigacion', $_REQUEST['Linea_Investigacion']);

	        $resultado=$obj->Almacenar($entidad);
	        if ($resultado>0) {
	        	 header('Location: index.php?md=si');
	        	
	        }
	        else
	        {
	        	header('Location: index.php?md=no');
	        }
	        
 
 	   }    
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Karen Angulo - Alonso Díaz</title>
	 <link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="Css/bootstrap.css">
	 <link rel="stylesheet" type="text/css" href="stilo.css">
</head>
<body>
      

	 <div class="jumbotron">
		  <div class="container">
		    <h1>Desarrollo Web</h1>
			    <p>Karen Angulo Florez - Alonzo Díaz
			    <br>
			    <a class="btn btn-primary btn-lg" role="button" href="Registro.php">Nuevo Proyecto</a>
			    <a class="btn btn-warning btn-lg" role="button" href="index.php">Ver Lista de proyectos</a></p>
		  </div>
	</div>
	

	<div class="panel panel-default tamano">
	  <div class="panel-heading">
		    <h3 class="panel-title">Registro de Proyectos</h3>
	</div>
        <div class="panel-body">
		
   
			<form role="form" method="POST" action="Registro.php"> 
			              <input type="hidden" name="Identificador" value="<?php echo $entidad->__GET('Identificador'); ?>" />
						  <div class="form-group">
						    <label for="ejemplo_email_1">Nombre del Proyecto</label>
						    <input type="text" class="form-control" id="ejemplo_email_1" name="Nombre_Proyecto" value="<?php echo $entidad->__GET('Nombre_Proyecto'); ?>" required>
						           
						  </div>
						  <div class="form-group">
						    <label for="ejemplo_password_1">Autores</label>
						    <input type="text" class="form-control" id="ejemplo_password_1" name="Autores" value="<?php echo $entidad->__GET('Autores'); ?>" required >
						          
						  </div>
						  <div class="form-group">
						    <label for="ejemplo_email_1">Nombre del Asesor</label>
						    <input type="text" class="form-control" id="ejemplo_email_1" name="Nombre_Asesor" value="<?php echo $entidad->__GET('Nombre_Asesor'); ?>" required>
						           
						  </div>
						  <div class="form-group">
						    <label for="ejemplo_password_1">Fecha de Ingreso</label>
						    <input type="date" class="form-control" id="ejemplo_password_1" name="Fecha_Ingreso" value="<?php echo $entidad->__GET('Fecha_Ingreso'); ?>" required>
						           
						  </div>
						  <div class="form-group">
						    <label for="ejemplo_email_1">Nota Final</label>
						    <input type="number" class="form-control" id="ejemplo_email_1" min="0" max="5" name="Nota" value="<?php echo $entidad->__GET('Nota'); ?>" required>
						         
						  </div>
						  <div class="form-group">
						    <label for="ejemplo_password_1">Linea de Investigación</label>
						    <input type="text" class="form-control" id="ejemplo_password_1" name="Linea_Investigacion" value="<?php echo $entidad->__GET('Linea_Investigacion'); ?>" required>
						           
						  </div>
						  
						 
						  <button type="submit" class="btn btn-primary">Registrar</button>
		      </form>

        </div>
	</div>
     
	<footer>
		 <center><h5>Todos los derechos reservados &copy 2016 Karen Angulo - Alonso Díaz</h5></center>
	</footer>


</body>
</html>
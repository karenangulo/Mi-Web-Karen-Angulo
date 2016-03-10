<?php 
 require_once 'Metodos.php';// //incluimos la clase metodo para que sea referida y poder utilizarla.
 $obj = new Metodos();//creamos una instancia de la clase metodos para acceder a todos los metodo contenidos en la clase. 

 if (isset($_REQUEST['id'])) { //validamos si existe id es por que vamos a eliminar un dato de la lista
    
 	 $resultado=$obj->Eliminar($_REQUEST['id']); //procedemos a eliminar
 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Karen Angulo - Alonso Díaz</title>
	 <link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="Css/bootstrap.css">
	  <link rel="stylesheet" type="text/css" href="stilo.css">
	  <script>
        function Confirmacion() {

            return confirm("¿Realmente desea eliminar el registro?");
        }
    </script>
</head>
<body>
      

	 <div class="jumbotron">
		  <div class="container">
		    <h1>Desarrollo Web</h1>
			    <p>Karen Angulo Florez - Alonzo Díaz</p>
			    <p><a class="btn btn-primary btn-lg" role="button" href="Registro.php">Nuevo Proyecto</a> 
			    	<a class="btn btn-primary btn-lg" role="button" href="index.php?consulta=si">Consultar</a></p>
		  </div>
	</div>
	<?php if (isset($_GET['consulta'])): ?>

		<div id="consulta">
			<center><h4>Busqueda Avanzada</h4></center>
		     <form role="form" method="POST" action="index.php">
                     
			  		 <input type="number" class="form-control orga" placeholder="Identificador" name="bid">
			  		 <input type="text" class="form-control orga" placeholder="Nombre proyecto" name="bnombre">
			  		 <input type="text" class="form-control orga" placeholder="Asesor" name="basesor">
			  		 <input type="text" class="form-control orga" placeholder="Nota" name="bnota">
			  		 <input type="text" class="form-control orga" placeholder="linea" name="blinea"><br><br>
			  		 <button type="submit"  class="btn btn-primary orga3">Busqueda Avanzada</button>
			      
			   </form>
	    </div>
		
	<?php endif ?>
	
   
	<div class="panel panel-default tamano2">

	     <div class="panel-heading">
		    <h3 class="panel-title">Lista de Proyectos Registrados</h3>
	     </div>

        <div class="panel-body">

             <?php // segmento de validacion de mensajes
		            if (isset($_REQUEST['id']) && $resultado > 0) { ?> 

			           <div class="alert alert-info"><center>Información Eliminada Exitosamente</center></div>
		                
		     <?php } elseif (isset($_GET['ms']) && $_GET['ms']="si") { ?>
		     	 <div class="alert alert-info"><center>Información Editada Exitosamente</center></div>
		    <?php } elseif (isset($_GET['md']) && $_GET['md']="si") { ?>
		       <div class="alert alert-info"><center>Información Guardada Exitosamente</center></div>
		     <?php  }



		      ?>
		        <form role="form" method="POST" action="index.php">

			  		 <input type="text" class="form-control orga" placeholder="Digite el Codigo Identificador o nombre" name="ident" required>
			  		 <button type="submit"  class="btn btn-primary orga2">Buscar</button>
			      
			   </form>
               <?php if (isset($_REQUEST['ident']) || isset($_REQUEST['bid'])): ?>

               	<table border="1" class="table table-hover">
						       <thead>
						           <tr class="warning">
						           	    <th><b>Identificador</b></th>
						           	    <th><b>Nombre del proyecto</b></th>
						           	    <th><b>Autores</b></th>
						           	    <th><b>Nombre del Asesor</b></th>
						           	    <th><b>Fecha de Ingreso</b></th>
						           	    <th><b>Nota Final</b></th>
						           	    <th><b>Linea de Investigacion</b></th>
						           	    <th colspan="2"><b>Opciones</b></th>
						           </tr>
						         </thead>

						         <tbody>



						            <?php  

						            if (isset($_REQUEST['ident'])) {

						            	 foreach($obj->ListaProyectosId($_REQUEST['ident']) as $r): ?>

									      <tr>   
									      <td><?php  echo $r->__GET('Identificador');  ?> </td>
									      <td><?php  echo $r->__GET('Nombre_Proyecto');  ?> </td>
									      <td><?php  echo $r->__GET('Autores');  ?> </td>
									      <td><?php  echo $r->__GET('Nombre_Asesor');  ?> </td>
									      <td><?php  echo $r->__GET('Fecha_Ingreso');  ?> </td>
									      <td><?php  echo $r->__GET('Nota');  ?> </td>
									      <td><?php  echo $r->__GET('Linea_Investigacion');  ?> </td>
									      <td><a href="index.php?id=<?php echo $r->Identificador; ?>" OnClick="return Confirmacion();">Eliminar</a></td>
									      <td><a href="Registro.php?id=<?php echo $r->Identificador; ?>">Editar</a></td>
									      </tr>

									    <?php  endforeach; 
									 
									 }
									 if( isset($_REQUEST['bid']) ){ 

									 	  foreach($obj->ListaProyectosIdespecial($_REQUEST['bid'],$_REQUEST['bnombre'],$_REQUEST['basesor'],$_REQUEST['bnota'],$_REQUEST['blinea']) as $r): ?>

									      <tr>   
									      <td><?php  echo $r->__GET('Identificador');  ?> </td>
									      <td><?php  echo $r->__GET('Nombre_Proyecto');  ?> </td>
									      <td><?php  echo $r->__GET('Autores');  ?> </td>
									      <td><?php  echo $r->__GET('Nombre_Asesor');  ?> </td>
									      <td><?php  echo $r->__GET('Fecha_Ingreso');  ?> </td>
									      <td><?php  echo $r->__GET('Nota');  ?> </td>
									      <td><?php  echo $r->__GET('Linea_Investigacion');  ?> </td>
									      <td><a href="index.php?id=<?php echo $r->Identificador; ?>" OnClick="return Confirmacion();">Eliminar</a></td>
									      <td><a href="Registro.php?id=<?php echo $r->Identificador; ?>">Editar</a></td>
									      </tr>

									     <?php  endforeach;  

						            	
						            } ?>


						          
						       	</tbody>
				       </table>

				       
               	
               <?php endif ?>
               <br>
               <hr>
               <center><h3>Lista de Proyectos</h3></center>
			   <hr>
				       <table border="1" class="table table-hover">
						       <thead>
						           <tr class="warning">
						           	    <th><b>Identificador</b></th>
						           	    <th><b>Nombre del proyecto</b></th>
						           	    <th><b>Autores</b></th>
						           	    <th><b>Nombre del Asesor</b></th>
						           	    <th><b>Fecha de Ingreso</b></th>
						           	    <th><b>Nota Final</b></th>
						           	    <th><b>Linea de Investigacion</b></th>
						           	    
						           </tr>
						         </thead>

						         <tbody>

						            <?php  foreach($obj->ListaProyectos() as $r): ?>

									      <tr>   
									      <td><?php  echo $r->__GET('Identificador');  ?> </td>
									      <td><?php  echo $r->__GET('Nombre_Proyecto');  ?> </td>
									      <td><?php  echo $r->__GET('Autores');  ?> </td>
									      <td><?php  echo $r->__GET('Nombre_Asesor');  ?> </td>
									      <td><?php  echo $r->__GET('Fecha_Ingreso');  ?> </td>
									      <td><?php  echo $r->__GET('Nota');  ?> </td>
									      <td><?php  echo $r->__GET('Linea_Investigacion');  ?> </td>
									     
									      </tr>

									  <?php  endforeach;  ?>
						       	</tbody>
				       </table>

				  </div>
	</div>
	<footer>
		 <center><h5>Todos los derechos reservados &copy 2016 Karen Angulo - Alonso Díaz</h5></center>
	</footer>
     

</body>
</html>
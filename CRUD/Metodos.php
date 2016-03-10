<?php
 require_once 'Entidad.php'; // clase auxilizar contenedora del objeto de datos, de la base de datos.
class Metodos   //clase encargada de realizar 
{
	private $pdo; // atributo generico para contenedor de la conexion a la base de datos.

	public function __CONSTRUCT()
	{

		require('conexion.php'); //archivo contenedor de la conexion pdo con la base de datos en mysql, el archivo debido a que se encuentra en el contructor extablece la conexion automaticamente, en el momento en que se inmstancia la clase Metodos.
	}


	public function ListaProyectos() //metodo encargado de listar los datos de la tabla datos, la tabla datos es la que almacena la informacion de los proyectos.
	{
		try
		{
			$result = array(); // creamos un array auxiliar para contener el objeto de datos, de la base de datos.

			$stm = $this->pdo->prepare("SELECT * FROM datos "); // realizamos una consulta a todos los elementos de la tabla datos, para listarlos.
			$stm->execute(); // fuction propia de php para extablecer parametros, con seguridad anti injeccionmes. (no la utilizamos para listar)

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) //rrecorremos los elementos encontrados tras la consulta, estos elementos sonm contenidos en la variable $stm.
			{
				$alm = new Datos(); //creamos una instancia de la clase datos, la cual es nuestra entidad, para generar un dato de tipo objeto.

				$alm->__SET('Identificador', $r->Identificador); //cada elemento encontrado en la base de datos lo almacenamos en cada variable de nuestra entidad (Datos)
				$alm->__SET('Nombre_Proyecto', $r->Nombre_Proyecto);
				$alm->__SET('Autores', $r->Autores);
				$alm->__SET('Fecha_Ingreso', $r->Fecha_Ingreso);
				$alm->__SET('Nombre_Asesor', $r->Nombre_Asesor);
				$alm->__SET('Nota', $r->Nota);
				$alm->__SET('Linea_Investigacion', $r->Linea_Investigacion);
				$result[] = $alm;
			}

			return $result; //retornamos nuestro array de objetos para ser utilizado en una vista html.
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function ListaProyectosId($id) // funciona de igual forma que el metodo listar, con la unica diferencia de que este busca por Identificador.
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM datos WHERE Identificador='$id' || Nombre_Proyecto like '%$id%'");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Datos();

				$alm->__SET('Identificador', $r->Identificador);
				$alm->__SET('Nombre_Proyecto', $r->Nombre_Proyecto);
				$alm->__SET('Autores', $r->Autores);
				$alm->__SET('Fecha_Ingreso', $r->Fecha_Ingreso);
				$alm->__SET('Nombre_Asesor', $r->Nombre_Asesor);
				$alm->__SET('Nota', $r->Nota);
				$alm->__SET('Linea_Investigacion', $r->Linea_Investigacion);
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function ListaProyectosIdespecial($id,$nom,$ase,$nota,$line) // funciona de igual forma que el metodo listar, con la unica diferencia de que este busca por Identificador.
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM datos WHERE (Nombre_Proyecto like '%$nom%') and (Nombre_Asesor like '%$ase%') and (Linea_Investigacion like '%$line%') and (Nota like '%$nota%') and (Identificador like '%$id%') ");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Datos();

				$alm->__SET('Identificador', $r->Identificador);
				$alm->__SET('Nombre_Proyecto', $r->Nombre_Proyecto);
				$alm->__SET('Autores', $r->Autores);
				$alm->__SET('Fecha_Ingreso', $r->Fecha_Ingreso);
				$alm->__SET('Nombre_Asesor', $r->Nombre_Asesor);
				$alm->__SET('Nota', $r->Nota);
				$alm->__SET('Linea_Investigacion', $r->Linea_Investigacion);
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function Almacenar(Datos $r){ //metodo designado para almacenar la informacion de un proyecto, en la tabla datos. como parametros resive un objeto de tipo Datos, recordemos que Datos en una entidad auxiliar, para manipular un objetos contituido por parios atributos.
		
		try 
		{
		$sql = "INSERT INTO datos (Nombre_Proyecto,Autores,Fecha_Ingreso,Nombre_Asesor,Nota,Linea_Investigacion) 
		        VALUES (?,?, ?, ?, ?, ? )";
		
		  $res=$this->pdo->prepare($sql)
		     ->execute(
			array(
				$r->__GET('Nombre_Proyecto'),
				$r->__GET('Autores'), 
				$r->__GET('Fecha_Ingreso'), 
				$r->__GET('Nombre_Asesor'),
				$r->__GET('Nota'),
				$r->__GET('Linea_Investigacion')
				
				)
			);

		     return $res; 
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		

    }
    public function Editar(Datos $r){ //metodo designado para la edicion en base al identificador.
		
		try 
		{
		$sql = "UPDATE datos SET 
						Nombre_Proyecto          = ?, 
						Autores          = ?, 
						Fecha_Ingreso        = ?,
						Nombre_Asesor           = ?, 
						Nota = ?,
						Linea_Investigacion = ?
						
				    WHERE Identificador = ?";;
		
		  $res=$this->pdo->prepare($sql)
		     ->execute(
			array(
				$r->__GET('Nombre_Proyecto'),
				$r->__GET('Autores'), 
				$r->__GET('Fecha_Ingreso'), 
				$r->__GET('Nombre_Asesor'),
				$r->__GET('Nota'),
				$r->__GET('Linea_Investigacion'),
				$r->__GET('Identificador'),
				
				)
			);

		     return $res; 
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		

    }
     public function Eliminar($id){ //metodo designado para la eliminacion el la base de datos, en base a un identificador.
		
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM datos WHERE Identificador = ?");			          

			$res=$stm->execute(array($id));
			return $res;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		

    }
    public function ObtenerRegistro($id){ //metodo encargado de optener un dato de la base de datos, para luego servir de guia en la edicion.
    	try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM datos WHERE Identificador = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			    $alm = new Datos();

				$alm->__SET('Identificador', $r->Identificador);
				$alm->__SET('Nombre_Proyecto', $r->Nombre_Proyecto);
				$alm->__SET('Autores', $r->Autores);
				$alm->__SET('Fecha_Ingreso', $r->Fecha_Ingreso);
				$alm->__SET('Nombre_Asesor', $r->Nombre_Asesor);
				$alm->__SET('Nota', $r->Nota);
				$alm->__SET('Linea_Investigacion', $r->Linea_Investigacion);


			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

    }
	

	
}


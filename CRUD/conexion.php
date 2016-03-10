<?php
      try
		{
			
			$this->pdo = new PDO('mysql:host=localhost;dbname=trabajo_de_grado', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}

?>

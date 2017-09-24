<?php
/*
Класс для соединения с базой данных
*/
class Database extends PDO
{
	private $connection;

	public function __construct()
	{
		try{
			$this->connection = parent::__construct('mysql:host='.SERVER_NAME.';dbname='.DATABASE, USERNAME, PASSWORD);
		}
		catch(PDOException $e){
			echo 'ERROR '.$e->getMessage();
		}
		
	}
	
}
?>
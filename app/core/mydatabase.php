<?php
/*
Класс для соединения с базой данных
*/
require_once 'app/core/server_info.php';
class MyDatabase
{
	
	private $connection;

	public function __construct()
	{
		$this->server="localhost";
		try{
			$this->connection = new PDO('mysql:host='.SERVER_NAME.';dbname='.DATABASE, USERNAME, PASSWORD);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo 'ERROR '.$e->getMessage();
		}
		
	}
	public function insert($table,$data){
		try {
			$sql = 'INSERT INTO '.$table.' (';
			$keys='';
			$values='';
			foreach ($data as $key => $value) {
				$keys.=$key.',';
				$values.='"'.$value.'",';
			}
			$sql .=substr($keys,0,strlen($keys)-1).') VALUES ('.substr($values,0,strlen($values)-1).');';
			$this->connection->exec($sql);
			return false; 
		} catch (PDOException $e) {
			echo 'ERROR '.$e->getMessage();
		}
		
	}
	public function select($table,$data='*',$option=null){
		try {
			if ($option!==null) {
				$sql = 'SELECT '.$data.' FROM '.$table.' '.$option.';';
			}
			else{
				$sql='SELECT '.$data.' FROM '.$table.';';
			}
			$var = $this->connection->prepare($sql);
			$var->execute();
			$result = $var->fetchAll();
			return $result;

		} catch (PDOException $e) {
			echo 'ERROR '.$e->getMessage();
		}
		
	}

	//Подумать
	public function update($table,$new,$old){
		try {
			$data = '';
			$where = '';
			foreach ($new as $key => $value) {
				$data.=$key.'="'.$value.'",';
			}
			foreach ($old as $key => $value) {
				$where.=$key.'="'.$value.'" AND';
			}
			$sql='UPDATE '.$table.' SET '.substr($data,0,strlen($data)-1).' WHERE '.substr($where,0,strlen($where)-4).';';
			$this->connection->exec($sql);
		} catch (PDOException $e) {
			echo 'ERROR '.$e->getMessage();			
		}
	}

	public function delete($table,$where){
		try {
			$sql='DELETE FROM '.$table.' WHERE id="'.$where.'";';
			$this->connection->exec($sql);
			return false;
		} catch (PDOException $e) {
			echo 'ERROR '.$e->getMessage();	
		}

	}
	public function __destruct(){
		$this->connection =null;
	}
	
}
?>
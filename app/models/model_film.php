<?php
/**
* Класс подгружающий все изображения в галлерею из базы данных
*/
class Model_Film extends Model
{
	public function get_data($order='id'){
		$sql = $this->db->query('SELECT * FROM film ORDER BY '.$order);
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		return $sql->fetchAll();
	}
	public function set_film($data){
		$sql = $this->db->prepare('INSERT INTO film(title,year,image,format) VALUES (:title,:year,:image,:format);');
		$sql->execute($data['film']);
		$film_id = $this->db->lastInsertId();
		foreach ($data['actor'] as $value) {
			$sql = $this->db->prepare('INSERT INTO starring(actor_id,film_id) VALUES (:actor_id,:film_id);');
			$sql->bindParam(':actor_id', $value);
			$sql->bindParam(':film_id', $film_id);
			$sql->execute();
		}
		
	}
	public function set_film_file($data){
		$sql = $this->db->prepare('INSERT INTO film(title,year,format) VALUES (:title,:year,:format);');
		$sql1 = $this ->db->prepare('INSERT INTO actor(full_name) VALUES (:full_name);');
		$sql2 = $this->db->prepare('INSERT INTO starring(actor_id,film_id) VALUES (:actor_id,:film_id);');
		foreach ($data as $value) {
			$temp = $this->db->query('SELECT id FROM format WHERE name_format="'.$value['format'].'";');
			$temp->setFetchMode(PDO::FETCH_ASSOC);
			$film = array(':title'=>$value['title'],':year'=>$value['year'],':format'=>$temp->fetch()['id']);
			$sql->execute($film);
			$film_id = $this->db->lastInsertId();
			foreach ($value['stars'] as $val) {
				$temp = $this->db->query('SELECT id FROM actor WHERE full_name="'.$val.'";');
				$temp->setFetchMode(PDO::FETCH_ASSOC);
				$actor_id = $temp->fetch()['id'];
				if(empty($actor_id)){
					$sql1->bindParam(':full_name', $val);
					$sql1->execute();
					$actor_id = $this->db->lastInsertId();
				}
				$sql2->bindParam(':actor_id',$actor_id);
				$sql2->bindParam(':film_id',$film_id);
				$sql2->execute();
			}
		}
	}
	public function get_table($table){
		$sql = $this->db->query('SELECT * FROM '.$table.';');
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		return $sql->fetchAll();
	}
	public function get_count($table){
		$sql = $this->db->query('SELECT COUNT(id) as count FROM '.$table);
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		return $sql->fetch()['count'];
	}
	public function delete_film($id){
		$this->db->exec('DELETE FROM starring WHERE film_id="'.$id.'";');
		$this->db->exec('DELETE FROM film WHERE id="'.$id.'";');
	}
	public function info_film($option){
		$sql = $this->db->query('SELECT film.title as title, film.image as image, film.year as year, format.name_format as format, GROUP_CONCAT(actor.full_name SEPARATOR ", ") as actors FROM starring RIGHT JOIN film ON starring.film_id=film.id RIGHT JOIN actor ON starring.actor_id=actor.id RIGHT JOIN format ON film.format=format.id WHERE film.id="'.$option.'" GROUP BY film.id;');
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		return $sql->fetchAll()[0];
	}
}
?>
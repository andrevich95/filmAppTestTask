<?php
/**
* Класс подгружающий все изображения в галлерею из базы данных
*/
class Model_Main extends Model
{
	public function get_data($order = 'id'){
		$sql = $this->db->query('SELECT * FROM film ORDER BY '.$order);
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		return $sql->fetchAll();
	}

	public function get_search_data($option){
		$sql = $this->db->query('SELECT * FROM film WHERE film.title LIKE "%'.$option.'%" OR id IN(SELECT starring.film_id FROM starring JOIN actor ON starring.actor_id=actor.id WHERE actor.full_name LIKE "%'.$option.'%");');
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		return $sql->fetchAll();
	}

	public function get_actors(){
		$sql = $this->db->query('SELECT actor.id, actor.full_name, GROUP_CONCAT(film.title SEPARATOR ", ") AS films FROM starring RIGHT JOIN film ON starring.film_id=film.id RIGHT JOIN actor ON starring.actor_id=actor.id GROUP BY actor.id;');
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		return $sql->fetchAll();
	}
	public function delete_actor($id){
		$this->db->exec('DELETE FROM starring WHERE actor_id="'.$id.'";');
		$this->db->exec('DELETE FROM actor WHERE id="'.$id.'";');
	}
	public function get_hint($str){
		$sql = $this->db->query('SELECT film.title AS hint FROM film WHERE film.title LIKE "%'.$str.'%" UNION SELECT actor.full_name AS hint FROM actor WHERE actor.full_name LIKE "%'.$str.'%";');
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		return $sql->fetchAll();
	}


}
?>
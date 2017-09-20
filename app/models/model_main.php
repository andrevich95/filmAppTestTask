<?php
/**
* Класс подгружающий все изображения в галлерею из базы данных
*/
class Model_Main extends Model
{
	public function get_data(){
		$DB = new MyDatabase();
		return $DB->select('photo');
	}
}
?>
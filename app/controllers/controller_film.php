<?php

class Controller_Film extends Controller
{
	function __construct()
	{
		$this->model = new Model_Film();
		$this->view = new View();
	}
	public function action_add()
	{	
		$data = array('0'=>$this->model->get_table('format'),'1'=>$this->model->get_table('actor'));
		$this->view->generate('film.php','template.php',$data);
	}
	public function action_load()
	{	
		$this->view->generate('upload.php','template.php');
	}

	//Загрузка файлов и обработка. Без сохранения на сервере - парсинг файла и построчно выделение сущностей.
	public function action_upload()
	{	
		if(isset($_FILES['file_films']['tmp_name'])){
			$lines = file($_FILES['file_films']['tmp_name']);
			$data = [];
			for($i=0;$i<count($lines);$i+=5){
				if(isset($lines[$i]) and isset($lines[$i+1]) and isset($lines[$i+2]) and isset($lines[$i+3]))
				{
					$title = explode(':', $lines[$i]);
					$year = explode(':', $lines[$i+1]);
					$format = explode(':', $lines[$i+2]);
					$stars = explode(':', $lines[$i+3]);
					if($title[0]=='Title' and $year[0]=='Release Year' and $format[0]=='Format' and $stars[0]=='Stars'){
						$data[count($data)] = array('title'=>substr($title[1],1,strlen($title[1])-2),'year'=>substr($year[1], 1,strlen($year[1])-2),'format'=>substr($format[1], 1,strlen($format[1])-2),'stars'=>explode(', ',substr($stars[1], 1,strlen($stars[1])-2)));
					}
					else echo 'Not write format';
				}				
			}
		}
		$this->model->set_film_file($data);

		$data = $this->model->get_data();
		$this->view->generate('main.php','template.php',$data);
	}

	//Создание нового фильма в базе с подгрузкой фото
	public function action_new(){
		if(isset($_FILES['film_image'])){
			$uploadfile='assets/img/'.$_FILES['film_image']['name'];
			Smove_uploaded_file($_FILES['film_image']['tmp_name'], $uploadfile);
		}
		else $uploadfile='assets/img/template.png';
		$data = array('film'=>array(':title'=>$_POST['film_title'],':year'=>$_POST['film_year'],':image'=>$uploadfile,':format'=>$_POST['film_format']),'actor'=>$_POST['actors']);
		$this->model->set_film($data);

		$data = $this->model->get_data();
		$this->view->generate('main.php','template.php',$data);

	}
	//Удаление фильма из базы 
	public function action_remove(){
		$this->model->delete_film($_POST['id']);
		$data = $this->model->get_data();
		foreach ($data as $value) {
			echo '<tr id="'.$value['id'].'">
			<td>'.$value['id'].'</td>
			<td>'.$value['title'].'</td>
			<td>'.$value['year'].'</td>
			<td>
				<button class="btn btn-primary info" data-toggle="modal" data-target="#info_modal"><span class="glyphicon glyphicon-info-sign"></span></button>
				<button class="btn btn-primary remove"><span class="glyphicon glyphicon-remove"></span></button>
			</td>
			</tr>';
		}
	}
	public function action_info(){
		$data = $this->model->info_film($_POST['id']);
		echo ' <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">'.$data['title'].'</h4>
			      </div>
			      <div class="modal-body">
			      <img src="'.$data['image'].'"/>
			        <p><h3>Year:</h3> '.$data['year'].'</p>
			        <p><h3>Format:</h3> '.$data['format'].'</p>
			        <p><h3>Starring:</h3> '.$data['actors'].'</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>';
	}
}
?>

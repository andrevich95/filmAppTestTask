<?php

class Controller_Main extends Controller
{
	function __construct(){
		$this->model = new Model_Main();
		$this->view = new View();
	}
	public function action_index(){
		$data = $this->model->get_data();
		$this->view->generate('main.php','template.php',$data);
	}
	public function action_sort(){
		$order = 'id';
		if(isset($_POST['param'])) $order = $_POST['param'];
		$data = $this->model->get_data($order);	
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
	public function action_hint(){
		$data = $this->model->get_hint($_POST['str']);
		echo '<ul>';
		foreach ($data as $key => $value) {
			
			echo '<ol class="hint_a"><a>'.$value['hint'].'</a></ol>';
		}
		echo '</ul>';
	}
	//Удаление актеров из базы
	public function action_rmactors(){
		$this->model->delete_actor($_POST['id']);
		$data = $this->model->get_actors();
		foreach ($data as $value) {
			echo '<tr id="'.$value['id'].'">
			<td>'.$value['id'].'</td>
			<td>'.$value['full_name'].'</td>
			<td>'.$value['films'].'</td>
			<td><button class="btn btn-primary remove_actor"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>';
		}
	}
	//Поиск фильмов по актерам и фильмам
	public function action_search(){
		$data = $this->model->get_search_data(htmlspecialchars($_POST['search']));
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
	public function action_actors(){
		$data = $this->model->get_actors();
		$this->view->generate('actors.php','template.php',$data);
	}
}
?>

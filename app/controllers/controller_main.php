<?php

class Controller_Main extends Controller
{
	function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
	}
	public function action_index()
	{	
		$data = $this->model->get_data();
		$this->view->generate('main.php','template.php',$data);
	}
}
?>

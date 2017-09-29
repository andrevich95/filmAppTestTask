<?php
function __autoload($class){
	foreach (array('core','models','controllers') as $value) {
		if('./app/'.$value.'/'.strtolower($class).'.php') require_once './app/'.$value.'/'.strtolower($class).'.php';
	}	
}

class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		$root = array_search('film_app', $routes);
		/* получаем имена контроллера и действия 
			у меня url имеет вид localhost/имя_сайта/контроллер/действие
			для url вида имя_сайта/контроллер/действие индексация будет на 1 меньше
		*/
		if ( !empty($routes[$root+1]) )
		{	
			$controller_name = $routes[$root+1];
		}

		if ( !empty($routes[$root+2]) )
		{
			$action_name = $routes[$root+2];
		}

		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		// подключаем файлы модели и контроллера

		$model_file = strtolower($model_name).'.php';
		$model_path = "app/models/".$model_file;
		if(file_exists($model_path))
		{
			include "app/models/".$model_file;
		}
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "app/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "app/controllers/".$controller_file;
		}
		else
		{
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			Route::ErrorPage404();
		}
	
	}
	
	static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}
?>
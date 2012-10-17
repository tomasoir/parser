<?php
class Application
{
 protected static $_controller = DEFAULT_CONTROLER;
 protected static $_action = 'Index';
 protected static $_id ;

 public static function run()
	{
		
		$url = explode('/', $_SERVER['REQUEST_URI']);
		if ( !empty($url[1]) )	{	
			self::$_controller = $url[1];
		}
		
		if ( !empty($url[2]) ){
			self::$_action = $url[2];
		}
        
		if ( !empty($url[3]) )	{
			self::$_id = $url[3];
		}

		$model1 = 'Model'.self::$_controller;
		$controller = 'Controller'.self::$_controller;
		$action = 'action'.self::$_action;

        
		$model_file = $model1.'.php';
		$model_path= "modules/".self::$_controller."/models/".$model_file;
		
		if(file_exists($model_path))
		{
			include $model_path;
			
		}

		
		$controller_file = strtolower($controller).'.php';
		$controller_path = "modules/".self::$_controller."/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include $controller_path;
		}
		else
		{
			
                       throw new Exception("Cannot Found Controler $url");
		}
		
		
		$controller = new $controller;
		
		
		if(method_exists($controller, $action))
		{
		
			$controller->$action();
		}
		else
		{
		
			 throw new Exception("Cannot Found Action $url");
		}
	
	}

	public static function getId() {
	   return self::$_id;
	}
 
}
?>
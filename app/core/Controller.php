<?php 

/**
* 
*/
class Controller
{
	private static $db;

	public static function getDB() {
		if(!self::$db) {
			$driver_options = array(
			   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
			   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
			);
			self::$db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATA, DB_USER, DB_PASS, $driver_options);
		}
		return self::$db;
	}

	protected function model($model) {
		require_once SC_DIR.'/app/models/'.$model.'.php';
		return new $model(self::getDB());
	}

	protected function view($view, $data = []) {
		require_once SC_DIR.'/app/views/'.$view.'.php';
	}

	protected function redirect($arr) {
		if(gettype($arr) == "array") {
			echo '<div style="width:80%;margin:20px auto;padding:20px;color:#999;background:#fefefe;"><h2>'.$arr['title'].'</h2>';
			echo '<p>'.$arr['message'].'</p>';
			echo '<p>Your will be redirected within in <span class="time">2</span> second...</p></div>';
			echo '<script>var rt = 2000;setTimeout(function(){window.location.href="'.SC_URL.$arr['url'].'"},rt);</script>';
		} else {
			header("Location: ".SC_URL.$arr);
		}
		die();
	}

	protected function setFlash($type, $msg) {
		echo '<script>console.log("set flash",window);window.onload = function(){so.flash("'.$type.'", "'+$msg+'")}</script>';
	}
}
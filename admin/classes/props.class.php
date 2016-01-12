<?php

class props{

	public function getir($page){

		if(file_exists("views/".$page)){
			include_once("views/".$page);
		}else{
			echo $page;
			die("<div class='alert alert-danger'>Sayfa Bulunamadı</div>");
		}

	}

	public function getControl($page){

		if(file_exists("controller/".$page)){
			include_once("controller/".$page);
		}else{
			die("<div class='alert alert-danger'>Sayfa Bulunamadı</div>");
		}

	}
	public function getPlugin($page){

		if(file_exists("plugin/".$page)){
			include_once("plugin/".$page);
		}else{
			die("<div class='alert alert-danger'>Sayfa Bulunamadı</div>");
		}

	}

	/*AJAX PAGE Start*/
	public function getPluginX($page){

		if(file_exists("../plugin/".$page)){
			include_once("../plugin/".$page);
		}else{
			die("<div class='alert alert-danger'>Sayfa Bulunamadı</div>");
		}

	}
	/*AJAX PAGE END*/


	public function plugins($plugin){
		if(file_exists("plugin/$plugin.php")){

			$plugin_name="plugin/".$plugin.".php";
			$getPluginConst=file($plugin_name);
			echo '<li><a href="modul/'.$plugin.'">'.str_replace("#","",$getPluginConst[1]).'</a></li>';

		}else{

			echo '<li><a href="#">Geçersiz Plugin : '.$plugin.'</a></li>';


		}

	}


	public function pluginsLeft($plugin){
		if(file_exists("plugin/$plugin.php")){

			$plugin_name="plugin/".$plugin.".php";
			$getPluginConst=file($plugin_name);
			echo '<a href="modul/'.$plugin.'"  class="list-group-item"><strong>'.str_replace("#","",$getPluginConst[1]).'</strong></a>';

		}else{

			echo '<a href="#"  class="list-group-item">Geçersiz Plugin : '.$plugin.'</a>';


		}

	}

	public function pluginText($plugin, $satir){
		if(file_exists("plugin/$plugin.php")){

			$plugin_name="plugin/".$plugin.".php";
			$getPluginConst=file($plugin_name);
			echo str_replace("#","",$getPluginConst[$satir]);

		}

	}

	public function columnCheck($columns, $table){

		$_cols = explode(",", $columns);
		$_e_cols = array();
		foreach($_cols as $col){

			$check = $GLOBALS["pdo"]->query("SHOW COLUMNS FROM ".$table." LIKE '".$col."'")->rowCount();
			if(!$check){

				array_push($_e_cols, $col);

			}

		}

		return $_e_cols;

	}


}

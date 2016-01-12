<?php
/*

CREATED BY Kadir Fırat (Echo)
Date : 01.01.2016

Open Source FrameWork
Version: 1.0.0

*/
ob_start();
session_start();
include "db.const.php"; //Database Connection File
//Class Pages Start
function __autoload($classFile){ /// -------------\

require_once "classes/".$classFile.".class.php"; //This function is php class _autoload function. İf you want add your class file, file name change to "class_file_name.class.php" and upload "classes" folder
} //////////////////////////////////---------//
// İf you do add your class file and do you want using your class. ex : $GLOBALS["your_variable"] = new class_name();. use ex : $GLOBALS["your_variable"]->function();
$GLOBALS["_PROPS"] = new props(); // Framework Main Prop Class File.
$GLOBALS["_PARSE"] = new parser(); // Framework data parser class file.
$GLOBALS["_FORM_DRAW"] = new form_draw(); // Framework admin panel auto db to form drawer.
$GLOBALS["_CHARTS"] = new charts(); // Framework auto db to chart.
$GLOBALS["_PARSE"];
$GLOBALS["_PROPS"];
$GLOBALS["_FORM_DRAW"];
//Class Pages Finish


//ADMINUSERFETCH
$GLOBALS["ADMIN_FETCH"] = $GLOBALS["pdo"]->query("SELECT * FROM echo_admins WHERE id='".$_SESSION['aid']."'")->fetch(PDO::FETCH_ASSOC);
//ADMINUSERFETCHEND


//Classes
$onPage = $_PARSE->parset(@$_GET['sayfa']).".php"; // On page.
$urli = $_PARSE->parset(@$_GET['sayfa']); // Your page is get this variable. If you say "How it is ?" read and research .htaccess file.
$url = array_filter(explode('/', $urli)); //URL to Array. ex: page1/page2/page3
$GLOBALS["url"] = $url;  // Your URL Array goes to GLOBAL variable because this variable using another pages.
//print_r($url); // Do you want see url disactive to active so please delete "//".


//Header
$_PROPS->getir("header.php"); // "getir" function is calling header.php in views folder. Views folder in html pages but .php extension because if you can want use php on html.
//Content
if ( isset($url[0]) && file_exists('views/' . $url[0] . '.php') ) // check views folder.
	$_PROPS->getir($url[0].".php"); // If exists file in views folder calling page.
else {
	if(isset($_SESSION['aid'])){ // If you create admin session so logged in automatically calling main page.
		$_PROPS->getir("index.php");
	}else{
		$_PROPS->getir("giris.php"); // If you dont create admin session so not logged in automatically calling login page.


	}
}

//Footer
$_PROPS->getir("footer.php");
?>

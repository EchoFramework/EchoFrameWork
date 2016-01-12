<?php


$GLOBALS["_settings"] = array(
	"type" => "chart", // Chart, Module(Plug-in) If your plug-in is chart add type=>"chart" to  _settings array
	"name" => "Who visit my site ?",
	"version" => "1.0",
	"add" => false,
	"delete" => false,
	"edit" => false,
	"table" => "echo_visit_stat",
	"perms" => "all",
	"form_record_succes_msg" => "",
	"form_edit_succes_msg" => "",




);

$GLOBALS["table_exists"] = false;
$GLOBALS["errors"] = array();


$select = $GLOBALS["pdo"]->query('SELECT * FROM '.$GLOBALS["_settings"]["table"]);
if(!$select)
{
	$GLOBALS["table_exists"] = false;
}else{

	$GLOBALS["table_exists"] = true;

}

if($GLOBALS["table_exists"] == false){
	if(!isset($_POST['const_table'])){
		echo '
		<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Tablo bulunamadı !</strong> '.$GLOBALS["_settings"]["table"].' tablosu yok. Oluşturmak için işlem başlatmak ister misiniz ?
		<form action="" method="post">
		<input type="submit" name="const_table" value="Evet">
		</form>
		</div>
		';
		exit('<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Devam Etmek İçin Tabloyu Oluşturunuz.</strong>
		</div>');
	}else{

		$sql ="CREATE table ".$GLOBALS["_settings"]["table"]."(
		id INT( 11 ) AUTO_INCREMENT PRIMARY KEY);";
		if($GLOBALS["pdo"]->query($sql)){

			echo '
			<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Tablo Oluşturuldu !</strong> '.$GLOBALS["_settings"]["table"].' tablosu açıldı.
			</div>
			';

		}else{

			echo '
			<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Tablo açılamadı !</strong> '.$GLOBALS["_settings"]["table"].' tablosu oluşturulamadı. Tekrar Oluşturmak için işlem başlatmak ister misiniz ?
			<form action="" method="post">
			<input type="submit" name="const_table" value="Evet">
			</form>
			</div>
			';

		}

	}
}

$GLOBALS["_form"] = array(
	'key' => "date", // If your plug-in is chart, this paramter is for use on SQL WHERE or GROUP BY. If you see ex goes to last line.

	'ip' => array(
		"isim" => "",
		"type" => "",
		"db_type" => "varchar",
		"length" => "255",
		"readonly" => false,
		"chart_type" => "value",
		"placeholder" => "",
		"hata_mesaji" => "",
		"user__register_ui" => true,
		"user_login_ui" => true,
		"empty" => false



	),
	'date' => array(
		"isim" => "",
		"type" => "",
		"db_type" => "varchar",
		"length" => "255",
		"readonly" => false,
		"chart_type" => "key",
		"placeholder" => "",
		"hata_mesaji" => "",
		"user__register_ui" => true,
		"user_login_ui" => true,
		"empty" => false

	)
);


$_element_keys = array();

foreach($GLOBALS["_form"] as $key => $val){
	if($key != "key"){
		array_push($_element_keys, $key);
	}
}

$_elements = implode(",", $_element_keys);
$checked = $GLOBALS["_PROPS"]->columnCheck($_elements, $GLOBALS["_settings"]["table"]);
if(count($checked) > 0){

	if(!isset($_POST['const_cols'])){
		foreach ($checked as $ch) {
			echo '
			<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Sütun bulunamadı !</strong> '.$ch.' -> '.$GLOBALS["_form"][$ch]["db_type"].'('.$GLOBALS["_form"][$ch]["length"].') sütunu yok.
			</div>
			';
		}
		exit('<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Devam Etmek İçin Sütunları Oluşturunuz. Devam etmek istiyor musunuz ?</strong>
		<form action="" method="post">
		<input type="submit" name="const_cols" value="Evet">
		</form>
		</div>');
	}else{
		foreach ($checked as $ch) {

			if($GLOBALS["_form"][$ch]["db_type"] != "text"){
				if($GLOBALS["pdo"]->exec("ALTER TABLE ".$GLOBALS['_settings']["table"]." ADD ".$ch." ".$GLOBALS["_form"][$ch]["db_type"]."(".$GLOBALS["_form"][$ch]["length"].")")){
					echo '
					<div class="alert alert-access">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Sütun Oluşturuldu !</strong> '.$ch.' -> '.$GLOBALS["_form"][$ch]["db_type"].'('.$GLOBALS["_form"][$ch]["length"].') sütunu oluşturuldu.
					</div>
					';
				}
			}else{

				if($GLOBALS["pdo"]->exec("ALTER TABLE ".$GLOBALS['_settings']["table"]." ADD ".$ch." ".$GLOBALS["_form"][$ch]["db_type"]."")){
					echo '
					<div class="alert alert-access">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Sütun Oluşturuldu !</strong> '.$ch.' -> '.$GLOBALS["_form"][$ch]["db_type"].'('.$GLOBALS["_form"][$ch]["length"].') sütunu oluşturuldu.
					</div>
					';
				}

			}
		}
	}

}

$GLOBALS["rows"] = $GLOBALS["pdo"]->query("SELECT ".$_elements." FROM ".$GLOBALS['_settings']["table"]. " GROUP BY ".$GLOBALS["_form"]["key"]." LIMIT 0, 7")->fetchAll(PDO::FETCH_ASSOC);

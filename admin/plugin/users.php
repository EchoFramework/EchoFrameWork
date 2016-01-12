<?php
##Üyeler //This area is your plug-in title.
##Üyeler Eklentisi //This area is your plug-in name.
##V1.0 //This area is your plug-in version.
##Yapımcı : Kadir Fırat & Sedat Göç //this area is plug-in creators.


//This variable is exists your plug-in settings.
$GLOBALS["_settings"] = array(

	"name" => "Üyeler Eklentisi", //Plug-in name/title
	"version" => "1.0", //plug-in version.
	"add" => true, //If this value "true" give to you add record perms.
	"delete" => true, //If this value "true" give to you delete record perms.
	"edit" => true,//If this value "true" give to you edit record perms.
	"table" => "echo_users", //Plug-in database table.
	"perms" => "all", //Plug-in permissions (admin, moderator (all => admin and moderators, "oadmin"=> only admins))
	"form_record_succes_msg" => "Kayıt başarıyla eklendi.", // your add record form success messages.
	"form_edit_succes_msg" => "Kayıt başarıyla düzenlendi.", // your edit record form success messages.




);

$GLOBALS["table_exists"] = false; // If table exists.
$GLOBALS["errors"] = array(); //Errors.


$select = $GLOBALS["pdo"]->query('SELECT * FROM '.$GLOBALS["_settings"]["table"]); //Check this table exists.
if(!$select) //If not exists this table
{
	$GLOBALS["table_exists"] = false; // table_exists variable is goes to false.
}else{

	$GLOBALS["table_exists"] = true;// table_exists variable is goes to true.

}

if($GLOBALS["table_exists"] == false){ // If do not have table this area is automatically create your table :) -> $GLOBALS["_settings"]["table"]
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
//This area is need for table columns.
$GLOBALS["_form"] = array(
	//'uye_adi' is key and column name.
	'uye_adi' => array(
		"isim" => "Üye Adı", // Form label name
		"type" => "text", //Form input type
		"db_type" => "varchar", //database column type
		"length" => "25", //length
		"readonly" => false,
		"page_show" => true, //Show listing.
		"placeholder" => "",
		"hata_mesaji" => "",
		"empty" => false //If this input allow empty value turn to true or disallow empty value turn to false.


	),
	'uye_sifre' => array(
		"isim" => "Şifre",
		"type" => "password",
		"db_type" => "varchar",
		"length" => "25",
		"readonly" => false,
		"page_show" => false,
		"placeholder" => "",
		"hata_mesaji" => "",

		"user_login_ui" => true,
		"empty" => false

	),
	'uye_eposta' => array(
		"isim" => "E-Posta",
		"type" => "text",
		"db_type" => "varchar",
		"length" => "25",
		"readonly" => false,
		"page_show" => true,
		"placeholder" => "",
		"hata_mesaji" => "",
		"empty" => false

	),
	'uye_telefon' => array(
		"isim" => "Telefon",
		"type" => "text",
		"db_type" => "int",
		"length" => "11",
		"readonly" => false,
		"page_show" => true,
		"placeholder" => "",
		"hata_mesaji" => "",
		"empty" => false

	),
	'uye_yetki' => array(
		"isim" => "Yetki",
		"type" => "text",
		"db_type" => "int",
		"length" => "2",
		"readonly" => false,
		"page_show" => true,
		"placeholder" => "",
		"hata_mesaji" => "",
		"empty" => false

	),
	'uye_dt' => array(
		"isim" => "Doğum Tarihi",
		"type" => "date",
		"db_type" => "varchar",
		"length" => "10",
		"readonly" => false,
		"page_show" => false,
		"placeholder" => "",
		"hata_mesaji" => "",
		"empty" => false
	),
);


//This area is check your columns.
//If you haven't columns this area is automatically create columns.

$_element_keys = array();

foreach($GLOBALS["_form"] as $key => $val){
	array_push($_element_keys, $key);
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

//And this plug-in file is returning rows.
$GLOBALS["rows"] = $GLOBALS["pdo"]->query("SELECT * FROM ".$GLOBALS['_settings']["table"])->fetchAll();

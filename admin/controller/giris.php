<?php
include "db.const.php";

if(isset($_POST['giris_yap'])){
	$_E["hata"] = "";
	$_E["tamam"] = "";
	$uname = $GLOBALS["_PARSE"]->parset($_POST['uname']);
	$passw = $GLOBALS["_PARSE"]->parset($_POST['passw']);

	if(!empty($uname) or !empty($passw)){

		$query = $pdo->query("SELECT * FROM echo_admins WHERE uname = '{$uname}' AND pword = '".sha1(md5($passw))."'")->fetch(PDO::FETCH_ASSOC);
		if ( $query ){
			$_E["tamam"] = "Başarıyla Giriş Yaptınız./";
			$_SESSION['aid'] = $query['id'];
			header("refresh:2;url=/myproject/admin/");
		}else{
			$_E["hata"] .= "Yanlış Şifr veya Kullanıcı Adı Girdiniz./";
		}

	}else{
		$_E["hata"] .= "Boş alan bırakmayınız./";
	}


$GLOBALS["_ER"] = explode("/", $_E["hata"]);
$GLOBALS["_TA"] = explode("/", $_E["tamam"]);


}

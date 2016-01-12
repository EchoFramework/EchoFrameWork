<?php
ob_start();
session_start();
include "../db.const.php";
//Class Pages Start
function __autoload($classFile){

  require_once "../classes/".$classFile.".class.php";

}

$GLOBALS["_PROPS"] = new props();
$GLOBALS["_PARSE"] = new parser();
$GLOBALS["_FORM_DRAW"] = new form_draw();
$GLOBALS["_PARSE"];
$GLOBALS["_PROPS"];
$GLOBALS["_FORM_DRAW"];
//Class Pages Finish
//This page documentation is on this url => 

if(isset($_SESSION['aid'])){

  if(isset($_POST["islem"]) && $_POST["islem"] == "sil"){

    if(isset($_POST["PLUG"])){
      $GLOBALS["_PROPS"]->getPluginX($_POST["PLUG"].".php");
    }

    $rows = explode("|", $_POST["sil"]);
    if(count(@$rows) > 1){
      $basari = 0;

      foreach($rows as $s){
        if(!empty($s)){
          $sil = $GLOBALS["pdo"]->prepare("DELETE FROM ".$GLOBALS["_settings"]["table"]." WHERE id=".$s)->execute();
          if($sil){


            $basari++;

          }else{
            echo $GLOBALS["pdo"]->errorInfo();
          }
        }


      }

      if($basari == (count($rows) - 1)){
        echo "1";
      }else{
        echo "0";
      }

    }elseif(count(@$rows) == "1"){

      echo "1";

    }else{
      echo "0";
    }

  }


}else{
  exit();


}



?>

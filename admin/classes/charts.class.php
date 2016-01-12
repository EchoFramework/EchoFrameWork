<?php

class charts{

  public function chartMod($module){
    if(file_exists("plugin/".$module.".php")){
      include_once("plugin/".$module.".php");
      $keys = array();
      $vals = array();


      foreach($GLOBALS["rows"] as $id => $array){

        foreach($array as $key => $val){

          if(!is_numeric($key) and $key != "id" and $key != "cip"){
            if($GLOBALS["_form"][$key]["chart_type"] == "value"){

              array_push($vals, '"'.$GLOBALS["pdo"]->query("SELECT * FROM ".$GLOBALS['_settings']["table"]. " WHERE date='".$array[$GLOBALS["_form"]["key"]]."'")->rowCount().'"');

            }else{
              array_push($keys, '"'.$val.'"');
            }
          }
        }

      }

      echo '
      <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
      <div class="panel panel-danger">
        <div class="panel-heading">
          <h3 class="panel-title">'.$GLOBALS["_settings"]["name"].'</h3>
        </div>
        <div class="panel-body">
        <canvas id="canvas" class="canvas"></canvas><script>
        var modal = $("body");
        var canvas = modal.find(".canvas");
        var ctx = canvas[0].getContext("2d");
        var chart = new Chart(ctx).Line({
          responsive: true,
          labels: ['.implode(",", $keys).'],
          datasets: [{
              fillColor: "rgba(151,187,205,0.2)",
              strokeColor: "rgba(151,187,205,1)",
              pointColor: "rgba(151,187,205,1)",
              pointStrokeColor: "#fff",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(151,187,205,1)",
              data: ['.implode(",", $vals).']
          }]
        },{});</script>
        </div>

      </div>


      </div>


      ';


    }else{
      die("<div class='alert alert-danger'>Sayfa Bulunamadı</div>");
    }
  }

}
?>

<?php
//This file is framework file.
//This is calling your or installed plug-ins.
//IMPORTANT : This is not controller page. This file is view file so HTML And PHP
$GLOBALS["_PROPS"]->getir("menu.php"); // Calling navigation menu.
$GLOBALS["_PROPS"]->getPlugin(@$GLOBALS["url"][1].".php"); // Calling plugin control file. Ex: Your plugin name is users and this calling users.php in plugin folder.
$action = @$GLOBALS["url"][2]; // This is action parameter. Action Parameter is need for working post forms.

if(@$GLOBALS["_settings"]["type"] == "chart"){ // If you called plugin is "Chart" you needn't editing forms end post record forms.

  exit("<div class='alert alert-danger'>Bu eklenti bir Grafik uygulamasıdır. Kayıt ekleme, düzenleme, silme ve listeleme yapılamaz.</div>");

}
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;padding:10px;">
  <div class="page-header">
    <h1><?php echo $GLOBALS["_PROPS"]->pluginText($GLOBALS["url"][1], 2); ?><small><?php echo $GLOBALS["_PROPS"]->pluginText($GLOBALS["url"][1], 3); ?></small><small><?php echo $GLOBALS["_PROPS"]->pluginText($GLOBALS["url"][1], 4); ?></small></h1>
    <?php echo $GLOBALS["_settings"]["name"]; ?>
    <hr>
    <a class="btn btn-info" href="<?php echo $GLOBALS["url"][0]."/".$GLOBALS["url"][1]; ?>" ><span class="glyphicon glyphicon-list"></span> Listele</a>

    <?php
    if($GLOBALS["_settings"]["edit"] == true){
      ?>
      <a class="btn btn-warning edit_row"><span class="glyphicon glyphicon-pencil"></span> Düzenle</a>
      <?php
    }
    ?>
    <?php
    if($GLOBALS["_settings"]["add"] == true){
      ?>
      <a class="btn btn-success" href="<?php echo $GLOBALS["url"][0]."/".$GLOBALS["url"][1]; ?>/add"><span class="glyphicon glyphicon-ok"></span> Yeni Kayıt</a>
      <?php
    }
    ?>
    <?php
    if($GLOBALS["_settings"]["delete"] == true){
      ?>
      <a class="btn btn-danger delete_row del"><span class="glyphicon glyphicon-remove"></span> Kaydı Sil</a>
      <a class="btn btn-danger delete_rows del" style="display:none;"><span class="glyphicon glyphicon-remove"></span> Seçili Kayıtları Sil</a>
      <?php
    }
    ?>
    <?php if(!isset($action)) {  ?>
      <div class="accessAjax">

      </div>
      <div class='table-responsive'>
        <table class='table table-striped table-bordered table-hover table-condensed'>
          <thead>
            <tr>
              <th></th>
              <th>ID</th>
              <?php foreach ($GLOBALS["_form"] as $input => $sets) { ?>
                <?php if($sets['page_show'] == true){ ?>
                  <th> <?php echo $sets['isim']; ?></th>
                  <?php } ?>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>

                <?php

                if(count($GLOBALS["rows"]) > 0){
                  ?>

                  <?php

                  foreach ($GLOBALS["rows"] as $key => $deger) {
                    echo "<tr data-id='".$deger["id"]."' data-removed='0'>";
                    echo "<td><input type='checkbox' data-id='".$deger["id"]."' name='sil[]' value='".$deger["id"]."'></td>";
                    echo "<td>".$deger["id"]."</td>";
                    foreach($deger as $key => $val){

                      if(!is_numeric($key) and $key != "id"){

                        if($GLOBALS["_form"][$key]["page_show"] == true){
                          echo "<td>".$val."</td>";
                        }

                      }

                    }
                    echo "</tr>";
                  }

                  ?>

                  <?php
                }

                ?>
              </tbody>
            </table>
          </div>
          <?php }else{ ?>

            <?php
            if($action == "add"){
              if(isset($_POST['add'])){

                //INSERT INTO $table (key1, key2) VALUES ("val1", "val2")
                $fields = array();
                $vals = array();
                $questionS = array();
                $error = 0;
                foreach($_POST as $key => $val){
                  if($key != "add")
                  {

                    array_push($fields, $key);
                    if($GLOBALS["_form"][$key]["empty"] == false){
                      if(!empty($val)){
                        array_push($vals, $val);
                        array_push($questionS, "?");

                      }else{
                        $error++;
                      }
                    }else{

                      array_push($vals, '"'.$val.'"');
                      array_push($questionS, "?");

                    }

                  }
                }

                if($error >= 1){

                  echo '<hr>
                  <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Boş Alanlar !</strong> Kullandığınız eklenti formda boş alanları desteklemiyor ! Boş alan bırakmayınız !
                  </div>
                  ';

                }else{

                  $sqlSTR = "INSERT INTO ".$GLOBALS["_settings"]["table"]." (".implode(",", $fields).") VALUES (".implode(",",$questionS).")";
                  $QUERY = $GLOBALS["pdo"]->prepare($sqlSTR);


                  for ($i=1; $i <= count($questionS) ; $i++) {
                    $QUERY->bindParam($i, $vals[$i - 1]);

                  }
                  if($QUERY->execute()){
                    echo '<hr>
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Başarılı !</strong> '.$GLOBALS["_settings"]["form_record_succes_msg"].'
                    </div>
                    ';

                  }else{
                    echo '<hr>
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Başarısız !</strong> Bir Hata Oluştu !
                    </div>
                    ';
                  }

                }


              }
              ?>

              <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset3" style="margin-top:20px;">
                  <form action="" method="post">
                    <?php

                    foreach ($GLOBALS["_form"] as $key => $value) {
                      $GLOBALS["_FORM_DRAW"]->draw($value["type"], $key, $value["length"], $value["placeholder"], $value["isim"]);
                    }

                    ?>
                    <input type='submit' name="add" class='btn btn-success ' value="Ekle">

                  </form>
                </div>
              </div>

              <?php
            }elseif($action == "edit"){

              $row = $GLOBALS["_PARSE"]->parset($GLOBALS["url"][3]);
              $row_dets = $GLOBALS["pdo"]->query("SELECT * FROM ".$GLOBALS["_settings"]["table"]." WHERE id='".$row."'")->fetch();
              if(isset($_POST['edit'])){

                //UPDATE $table SET key1 = val1, key2 = val2
                $fields = array();
                $vals = array();
                $questionS = array();
                $error = 0;
                foreach($_POST as $key => $val){
                  if($key != "edit")
                  {

                    array_push($fields, $key." = ?");
                    if($GLOBALS["_form"][$key]["empty"] == false){
                      if(!empty($val)){
                        array_push($vals, $val);
                        array_push($questionS, "?");


                      }else{
                        $error++;
                      }
                    }else{

                      array_push($vals, '"'.$val.'"');
                      array_push($questionS, "?");


                    }

                  }
                }

                if($error >= 1){

                  echo '<hr>
                  <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Boş Alanlar !</strong> Kullandığınız eklenti formda boş alanları desteklemiyor ! Boş alan bırakmayınız !
                  </div>
                  ';

                }else{

                  $sqlSTR = "UPDATE ".$GLOBALS["_settings"]["table"]." SET ".implode(",", $fields)." WHERE id='".$GLOBALS["url"][3]."'";

                  $QUERY = $GLOBALS["pdo"]->prepare($sqlSTR);


                  for ($i=1; $i <= count($questionS) ; $i++) {
                    $QUERY->bindParam($i, $vals[$i - 1]);

                  }
                  if($QUERY->execute()){
                    echo '<hr>
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Başarılı !</strong> '.$GLOBALS["_settings"]["form_edit_succes_msg"].'
                    </div>
                    ';

                  }else{
                    echo '<hr>
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Başarısız !</strong> Bir Hata Oluştu !
                    </div>
                    ';
                  }

                }


              }
              ?>
              <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset3" style="margin-top:20px;">
                  <form action="" method="post">

                    <?php


                    foreach ($GLOBALS["_form"] as $key => $value) {

                      $GLOBALS["_FORM_DRAW"]->draw($value["type"], $key, $value["length"], $value["placeholder"], $value["isim"], $row_dets[$key]);
                    }


                    ?>
                    <input type='submit' name="edit" class='btn btn-success ' value="Kaydet">

                  </form>
                </div>
              </div>

              <?php

            }
            ?>


            <?php } ?>
          </div>
        </div>

        <script>
        //This area is for jquery and ajax.
        //You needn't edit this area becaause this area is get called plugin settings and table name so automatic ajax.

        $(document).ready(function(){

          $( "input[type=checkbox]" ).on( "click", function(){

            if($("tr[data-id="+$(this).data("id")+"]").attr("data-removed") == "0"){
              $("tr[data-id="+$(this).data("id")+"]").attr("data-removed", "1");

            }else{

              $("tr[data-id="+$(this).data("id")+"]").attr("data-removed", "0");

            }

          });

          $("input:checkbox").change(function(){
            if($('input:checkbox:checked').length > 1){

              //console.log($('input:checkbox:checked'));
              $(".delete_row").hide();
              $(".delete_rows").show();
              $(".edit_row").hide();
            }else{

              $(".delete_row").show();
              $(".delete_rows").hide();
              $(".edit_row").show();

            }
          });


          $(".del").click(function(){
            $(".accessAjax").empty();
            var checkbox_value = "";
            $("input:checkbox:checked").each(function () {
              var ischecked = $(this).is(":checked");
              if (ischecked) {
                checkbox_value += $(this).val() + "|";
              }
            });
            $.ajax({
              method: "POST",
              url: "assets/__ajaxPosts.php",
              data: {sil:checkbox_value, islem:"sil", PLUG:"<?php echo $GLOBALS["url"][1]; ?>"}
            })
            .done(function( msg ) {
              if(msg == "1"){
                $(".accessAjax").append('<hr><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Silindi !</strong> Seçtiğiniz veriler silindi !</div>');
                $("input:checkbox:checked").remove();
                $("[data-removed=1]").remove();
                window.setTimeout('location.reload()', 3000);
              }else{
                console.log(msg);
                $(".accessAjax").append('<hr><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Silemedik !</strong> Tüh, bir problem oluştu !</div>');

              }
            })
            .error(function (msg){
              alert("HATA !");
            });

          });

          $(".edit_row").on('click', function(){

            if($('input:checkbox:checked').length < 1){
              $("#hata p").html("Düzenlenecek bir satır seçmelisiniz.");
              $("#hata").modal("show");
            }else{
              if($('input:checkbox:checked').length > 1){
                $("#hata p").html("En fazla 1 satır düzenleyebilirsiniz.");
                $("#hata").modal("show");
              }else{
                window.location.href = "modul/<?php echo $GLOBALS["url"][1]; ?>/edit/"+$('input:checkbox:checked').val();
              }
            }

          });

        });

        </script>
        <div class="modal fade" id="hata" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Oops !</h4>
              </div>
              <div class="modal-body">
                <b><p></p></b>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
              </div>
            </div>
          </div>
        </div>

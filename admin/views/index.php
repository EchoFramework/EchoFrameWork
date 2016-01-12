<?php
$GLOBALS["_PROPS"]->getir("menu.php");
?>

<div class="alert alert-success">
  <strong>EchoFramework V1.0</strong> Released !
</div>

<div class="col-lg-3 col-md-3 col-sm-12 col-lg-12">
  <div class="list-group">
    <a href="#" class="list-group-item"> <strong> Anasayfa </strong> </a>
    <li class="list-group-item text-center"><strong>Eklentiler </strong><span class="glyphicon glyphicon-arrow-down"></span></li>

    <?php foreach ($GLOBALS["_PLUGINS"] as $eklenti) { ?>

      <?php
      $GLOBALS["_PROPS"]->pluginsLeft($eklenti);
      ?>

      <?php } ?>
    </div>
  </div>
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"> Yönetim Paneli </h3>
      </div>
      <div class="panel-body">
        <div class="col-lg-12">
        <?php
        foreach($GLOBALS["_CHART_PLUG"] as $chart){
          $GLOBALS["_CHARTS"]->chartMod($chart);
        }

        ?>
      </div>

        <h3>Hello Programmer, Welcome to EchoFramework !</h3>
        <p><strong>İf you want get information framework about visit our documentation page ! -> <a href="">Echo Framework</a></strong><p>
          <h3>Do you like this framework ?</h3>
          <p><strong>İf you like this framework system please donate me  ^_^ (Thanks for donate)-> <a href="">My Donate Link</a></strong></p>
          <h3>What is this ?</h3>
          <p><strong>This framework has very basic system. You can create plug-ins easier . -> <a href="">Go to Document</a></strong></p>
          <h3>Credits</h3>
          <p><strong>Creator Kadir Fırat</a></strong></p>
          <h3>About of Kadir Fırat(Me *-*) ?</h3>
          <p><strong>
            I'am Kadir Fırat and i 17 (seventeen) years old. I am a student in college(Computer Tech.). When I was 9 , I started writing code.<br /><br />
            My from is Turkey/Istanbul. I live in Turkey/Istanbul.</br><br />
            When I was 2, I meet the computer.<br /><br />
            Pull my interest soon became my only interest . After few years I was start coding .<br /><br />



          </strong></p>

        </div>
        <div class="panel-footer">

          Echo Frame Work &copy <?php echo date("Y"); ?> V1.0

        </div>
      </div>

    </div>

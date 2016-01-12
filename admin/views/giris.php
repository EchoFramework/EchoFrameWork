<?php
$GLOBALS["_PROPS"]->getControl("giris.php");
?>
<div class="page-header">
	<h1>Echo Admin Panel <small>V1.0</small></h1>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-lg-offset-4">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title text-center">Giriş Yap</h3>
		</div>
		<div class="panel-body">
			<?php if(isset($_POST['giris_yap'])){ foreach (@$GLOBALS["_ER"] as $error) { if(!empty($error)) {?>

				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Oops !</strong> <?php echo $error; ?>
				</div>

				<?php } } }?>
				<?php if(isset($_POST['giris_yap'])){ foreach (@$GLOBALS["_TA"] as $tamam) { if(!empty(@$tamam)) {?>

					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Tamamdır !</strong> <?php echo @$tamam; ?>
					</div>

					<?php } } }?>
					<form action="" method="POST" role="form">


						<div class="form-group">
							<label for="">Kullanıcı Adı : </label>
							<input type="text" name="uname" class="form-control" id="" placeholder="Kullanıcı Adınız...">
						</div>
						<div class="form-group">
							<label for="">Şifre : </label>
							<input type="password" name="passw" class="form-control" id="" placeholder="Şifreniz...">
						</div>


						<input type="submit" name="giris_yap" value="Giriş Yap" class="form-control btn-primary">
					</form>
					<a href="">Şifrenizi mi unuttunuz ? </a>


				</div>
			</div>
		</div>

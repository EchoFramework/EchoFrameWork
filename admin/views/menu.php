<?php
$GLOBALS["_PROPS"]->getControl("props/eklenti.php");
?>
<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Admin Panel</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li><a href="#">Anasayfa</a></li>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Eklentiler <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php foreach ($GLOBALS["_PLUGINS"] as $eklenti) { //Do you want add your plug-in in this menu ? Okay, go to controller->props folder. Open eklenti.php and read this document ->  ?>

							<?php
								$GLOBALS["_PROPS"]->plugins($eklenti);
							?>

						<?php } ?>
					</ul>
				</li>
			</ul>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $GLOBALS["ADMIN_FETCH"]["uname"]; ?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Log out</a></li>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>

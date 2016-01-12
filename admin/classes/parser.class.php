<?php

class parser{

	function parset($string){

		return htmlspecialchars(strip_tags(stripslashes($string)));

	}

}

<?php

class form_draw{

	function draw($type, $name, $length = 0, $placeholder="Form element...", $isim = "FORM_ELEMENT_NAME", $val = ""){

      if($type == "text" or $type == "password"){
        echo "<div class='form-group'>";
        echo "<label>".$isim."</label>";
        echo "<input class='form-control' type='".$type."' name='".$name."' value='".$val."' placeholder='".$placeholder."' maxlength='".$length."'>";
        echo "</div>";
      }elseif($type == "textarea"){

        echo "<div class='form-group'>";
        echo "<label>".$isim."</label>";
        echo "<textarea name='".$name."' placeholder='".$placeholder."' class='form-control' maxlength='".$length."'>'".$val."'</textarea>";
        echo "</div>";

      }elseif($type == "date"){

        echo "<div class='form-group'>";
        echo "<label>".$isim."</label>";
        echo "<input type='".$type."' name='".$name."' value='".$val."' placeholder='".$placeholder."' class='form-control'>";
        echo "</div>";

      }

  }

}

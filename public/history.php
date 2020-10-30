<?php
require("../includes/config.php");

$id = $_SESSION["id"];

$historys = CS50::query("SELECT * FROM history WHERE user_id = ?", $id);

render("history_form.php",["title"=>"History","historys"=>$historys]);

?>
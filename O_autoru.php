<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";

$smarty->assign("putanja",$putanja);
$smarty->display("oAutoru.tpl");





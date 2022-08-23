<?php

require "sesija.class.php";

require("$direktorij/vanjske_biblioteke/smarty-3.1.39/libs/Smarty.class.php");
Sesija::kreirajSesiju();

$smarty = new Smarty();
$smarty->setTemplateDir("$direktorij/templates");
$smarty->setCompileDir("$direktorij/templates_c");
$smarty->setPluginsDir(SMARTY_PLUGINS_DIR);
$smarty->setCacheDir("$direktorij/cache");
$smarty->setConfigDir("$direktorij/configs");

$smarty->assign("putanja",$putanja);

?>


<?php

require "../autoload.php";

require('/usr/local/lib/php/Smarty/libs/Smarty.class.php');

$smarty = new Smarty\Smarty;

$smarty->setTemplateDir(__DIR__ . '/smarty/templates');
$smarty->setCompileDir(__DIR__ . '/smarty/templates_c');
$smarty->setCacheDir(__DIR__ . '/smarty/cache');
$smarty->setConfigDir(__DIR__ . '/smarty/configs');

$smarty->assign('name', 'Ned');
$smarty->display('index.tpl');
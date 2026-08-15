<?php

namespace App\Http\Controllers;

require_once('/usr/local/lib/php/Smarty/libs/Smarty.class.php');

class BaseController
{
    public static $smarty;

    public static function initSmarty()
    {
        if (self::$smarty === null) {
            self::$smarty = new \Smarty\Smarty;
            self::$smarty->setTemplateDir(dirname(__DIR__, 3) . '/public/smarty/templates');
            self::$smarty->setCompileDir(dirname(__DIR__, 3) . '/public/smarty/templates_c');
            self::$smarty->setCacheDir(dirname(__DIR__, 3) . '/public/smarty/cache');
            self::$smarty->setConfigDir(dirname(__DIR__, 3) . '/public/smarty/configs');
        }
    }

}
<?php

namespace App\Http\Controllers;

class HomeController extends BaseController
{
    public static function index()
    {
        parent::initSmarty();

        parent::$smarty->assign('name', 'Ned');

        return parent::$smarty->display('index.tpl');
    }
}
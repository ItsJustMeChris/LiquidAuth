<?php
namespace LiquidAuth\Controllers;
class ViewController
{
    function setView($f_params)
    {
        $users = new \LiquidAuth\Classes\Users;
        if ($f_params[0] == "")
        {
            $header = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'header.html');
            $template = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'index.html');
            $footer = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'footer.html');
        }
        else
        {
            $header = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'header.html');
            $template = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.$f_params[0].'.html');
            $footer = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'footer.html');
        }
        $template->assign('user', $users->currentUserID());
        $header->show();
        $template->show();
        $footer->show();
    }
}
?>

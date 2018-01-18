<?php
namespace LiquidAuth\Controllers;
class ViewController
{
    function setView($f_params)
    {
        $users = new \LiquidAuth\Classes\Users;
        if ($f_params[0] == "")
        {
            if ($users->loggedIn())
            {
                $header = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'userheader.html');
                $header->assign('view', "index");
            }
            else
            {
                $header = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'guestheader.html');
            }
            $template = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'index.html');
            $footer = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'footer.html');
        }
        else
        {
            if ($users->loggedIn())
            {
                $header = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'userheader.html');
                $header->assign('view', "index");
                if ($f_params[0] == "login") {
                    $template = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'error.html');
                    $template->assign('error', "You're already logged in. ");
                }
                $footer = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'footer.html');
            }
            else
            {
                $template = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.$f_params[0].'.html');
                $header = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'guestheader.html');
            }
            $footer = new \LiquidAuth\Classes\Templates(TEMPLATES_PATH.'footer.html');
        }
        $header->assign('user', $users->currentUserID());
        $header->show();
        $template->show();
        $footer->show();
    }
}
?>

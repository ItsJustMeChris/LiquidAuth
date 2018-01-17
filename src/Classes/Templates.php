<?php
namespace LiquidAuth\Classes;
class Templates
{
    var $variables = array();
    var $template;
    function __construct($f_path = '')
    {
        if (!empty($f_path))
        {
            if (file_exists($f_path))
            {
                $this->template = file_get_contents($f_path);
            }
            else
            {
                die("Error: " . $f_path);
            }
        }
    }
    function assign($f_search, $f_replace)
    {
        if (!empty($f_search))
        {
            $this->variables[$f_search] = $f_replace;
        }
    }
    function show()
    {
        if (count($this->variables) > 0)
        {
            foreach($this->variables as $key => $value)
            {
                $this->template = str_replace('{$' . $key . '}', $value, $this->template);
            }
        }
        echo $this->template;
    }
}
?>

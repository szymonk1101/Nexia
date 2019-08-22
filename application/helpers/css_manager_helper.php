<?php

class CssManager
{
    protected static $_css = array();

    public static function add($url) {
        if(is_array($url)) {
            self::$_css = array_unique(array_merge(self::$_css, $url));
        } else {
            if(!in_array($url, self::$_css))
                array_push(self::$_css, $url);
        }
        
    }

    public static function render() {
        foreach(self::$_css as $js) {
            echo '<link rel="stylesheet" type="text/css" href="'.base_url($js).'" />'.PHP_EOL;
        }
    }
}
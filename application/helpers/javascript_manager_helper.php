<?php

class JavascriptManager
{
    protected static $_javascripts = array();

    public static function add($url) {
        if(is_array($url)) {
            self::$_javascripts = array_unique(array_merge(self::$_javascripts, $url));
        } else {
            if(!in_array($url, self::$_javascripts))
                array_push(self::$_javascripts, $url);
        }
        
    }

    public static function render() {
        foreach(self::$_javascripts as $js) {
            echo '<script type="text/javascript" src="'.base_url($js).'"></script>'.PHP_EOL;
        }
    }
}
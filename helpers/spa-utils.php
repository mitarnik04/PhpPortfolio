<?php

class SpaUtils
{

    private static $pages = [];

    static function getPages()
    {
        if (empty(self::$pages)) {
            $pageNames = array_map('basename', glob(__DIR__ . '/../views/*.php'));

            foreach ($pageNames as $pageName) {
                //Removes last five chars which in this case is ".php"
                self::$pages[] = substr($pageName, 0, -4);;
            }
        }

        return self::$pages;
    }
}

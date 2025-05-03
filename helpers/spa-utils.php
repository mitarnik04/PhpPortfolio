<?php

class SpaUtils
{

    private static $pages = [];

    static function getPages()
    {
        if (empty(self::$pages)) {
            self::$pages = array_map(function ($fullPath) {
                $viewName = basename($fullPath);
                return substr($viewName, 0, -4);
            }, glob(__DIR__ . '/../views/*.php'));
        }

        return self::$pages;
    }
}

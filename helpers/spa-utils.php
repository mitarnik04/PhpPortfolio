<?php
require_once __DIR__ . '/utils.php';

//TODO: Maybe rework this in the future together with TranslationUtils ?
class SpaUtils
{
    private static $pages = [];

    static function getPages()
    {
        if (empty(self::$pages)) {
            self::$pages = getFileNames(__DIR__ . '/../views/*.php', true);
        }

        return self::$pages;
    }
}

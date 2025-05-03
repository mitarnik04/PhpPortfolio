<?php

require_once(__DIR__ . '/utils.php');
require_once(__DIR__ . '/../user-settings.php');


class Translation
{
    private static $translations = [];


    public static function getTranslation(string $key, string $language): string
    {

        if (!isset(self::$translations[$language])) {

            self::loadTranslation($language);
        }

        return self::$translations[$language][$key];
    }

    private static function loadTranslation(string $language): void
    {

        $translation = [];

        if (!tryGetJsonContent(__DIR__ . '/../translations/' . $language . '.json', $translation)) {
            error_log('Could not get translation for language: ' . $language);
            return;
        }

        self::$translations[$language] = $translation;
    }
}

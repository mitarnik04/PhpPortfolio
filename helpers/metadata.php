<?php
require_once __DIR__ . '/utils.php';

class Metadata
{

    /** @var array<string> */
    private static array $translationFileNames;

    /** @var array<string> */
    private static array $viewFileNames;


    /** @return array<string> */
    public static function getAvailableLanguages(): array
    {
        if (!isset(self::$translationFileNames)) {
            self::$translationFileNames = getFileNames(__DIR__ . '/../translations/*.json', true);
        }

        return self::$translationFileNames;
    }

    /** @return array<string> */
    public static function getLoadableViews(): array
    {
        if (!isset(self::$viewFileNames)) {
            self::$viewFileNames = getFileNames(__DIR__ . '/../views/*.php', true);
        }

        return self::$viewFileNames;
    }
}

<?php
require_once __DIR__ . '/utils.php';

class TranslationUtils
{

    private static $translationNames = [];

    static function getAvailableTranslations(): array
    {
        if (empty(self::$translationNames)) {
            self::$translationNames = getFileNames(__DIR__ . '/../translations/*.json', true);
        }

        return self::$translationNames;
    }
}

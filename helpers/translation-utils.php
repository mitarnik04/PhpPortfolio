<?php

class TranslationUtils
{

    private static $translationNames = [];

    static function getAvailableTranslations(): array
    {
        if (empty(self::$translationNames)) {
            self::$translationNames = array_map(function ($fullPath) {
                $translationFileName = basename($fullPath);
                return substr($translationFileName, 0, -5);
            }, glob(__DIR__ . '/../translations/*.json'));
        }

        return self::$translationNames;
    }
}

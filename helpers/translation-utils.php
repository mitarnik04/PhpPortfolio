<?php

class TranslationUtils
{

    private static $translationNames = [];

    static function getAvailableTranslations(): array
    {
        if (empty(self::$translationNames)) {

            $translationFiles = array_map('basename', glob(__DIR__ . '/../translations/*.json'));

            foreach ($translationFiles as $translationFile) {
                //Removes last five chars which in this case is ".json"
                self::$translationNames[] = substr($translationFile, 0, -5);;
            }
        }

        return self::$translationNames;
    }
}

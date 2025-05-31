<?php

require_once __DIR__ . '/utils.php';
require_once __DIR__ . '/../user-settings.php';


class Translator
{
    private static array $translations = [];


    /** @param callable(string $language): string $getTranslationFile */
    public function __construct(
        private $getTranslationFile,
    ) {}


    public function get(string $key, string $language): string
    {

        if (!isset(self::$translations[$language])) {
            self::loadTranslation($language);
        }

        return str_contains($key, ':')
            ?  self::getNestedTranslation($key, $language)
            :  self::$translations[$language][$key];
    }

    private function loadTranslation(string $language): void
    {

        $translations = [];
        if (!tryGetJsonContent(($this->getTranslationFile)($language), $translations)) {
            throw new RuntimeException("Could not get translation for language: $language");
        }

        self::$translations[$language] = $translations;
    }

    private static function getNestedTranslation(string $key, string $language): string
    {
        $partialKeys = explode(':', $key);
        $currentPosition = self::$translations[$language];

        foreach ($partialKeys as $partialKey) {
            if (!is_array($currentPosition)) {
                throw new InvalidArgumentException("Invalid translation key: $key");
            }
            $currentPosition = $currentPosition[$partialKey];
        }

        return $currentPosition;
    }
}

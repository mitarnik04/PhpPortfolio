<?php
require_once DIR_HELPERS . '/timespan.php';

class UserSettings
{
    const COOKIE_NAME = 'userSettings';
    const LANGUAGE_PROP_NAME  = 'language';

    private string $language = 'en';

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $value): void
    {
        if ($this->language !== $value) {
            $this->language = $value;
            self::updateOrCreateCookie($this);
        }
    }

    public static function getOrCreate(): UserSettings
    {
        if (isset($_COOKIE[self::COOKIE_NAME])) {
            return self::readUserSettingsFromCookie();
        }

        $userSettings = new UserSettings();
        self::updateOrCreateCookie($userSettings);

        return $userSettings;
    }

    private static function updateOrCreateCookie(UserSettings $userSettings): void
    {
        //Since PHP does not support private classes we wrap the private prop in an object in order to be able to serialize it as JSON
        $userSettingsObj = [
            self::LANGUAGE_PROP_NAME => $userSettings->language,
        ];
        $json = json_encode($userSettingsObj);

        setcookie(self::COOKIE_NAME, $json, Timespan::oneYear(), '/');
    }

    private static function readUserSettingsFromCookie(): UserSettings
    {
        $json = json_decode($_COOKIE[self::COOKIE_NAME], true);
        $userSettings = new UserSettings();
        $userSettings->language = $json[self::LANGUAGE_PROP_NAME];
        return $userSettings;
    }
}

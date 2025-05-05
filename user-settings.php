<?php
class UserSettings
{
    const COOKIE_NAME = "userSettings";
    const LANGUAGE_PROP_NAME  = "language";

    private string $language = "en";

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $value): void
    {
        $userSettings = self::getOrCreate();
        if ($userSettings->language !== $value) {
            $userSettings->language = $value;
            self::updateOrCreateCookie($userSettings);
        }
    }

    public static function getOrCreate(): UserSettings
    {
        if (isset($_COOKIE[self::COOKIE_NAME])) {
            return self::readUserSettingsFromCookie();
        }


        require_once __DIR__ . '/helpers/timespan.php';

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

        require_once __DIR__ . '/helpers/timespan.php';


        $json = json_encode($userSettingsObj);
        setcookie(self::COOKIE_NAME, $json, Timespan::oneYear(), "/");
    }

    private static function readUserSettingsFromCookie(): UserSettings
    {
        $json = json_decode($_COOKIE[self::COOKIE_NAME], true);
        $userSettings = new UserSettings();
        $userSettings->language = $json[self::LANGUAGE_PROP_NAME];
        return $userSettings;
    }
}

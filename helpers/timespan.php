<?php

class Timespan
{

    private static int $oneYear;

    public static function oneYear(): int
    {
        if (!isset(self::$oneYear)) {
            self::$oneYear = time() + (86400 * 365);
        }

        return self::$oneYear;
    }
}

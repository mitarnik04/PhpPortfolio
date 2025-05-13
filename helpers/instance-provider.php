<?php

class InstanceProvider
{
    private static array $instances = [];


    public static function get(string $class): mixed
    {

        if (!array_key_exists($class, self::$instances)) {
            throw new RuntimeException('No instance present for class: ' . $class);
        }

        return self::$instances[$class];
    }

    public static function add(string $class, mixed $instance): void
    {

        if (array_key_exists($class, self::$instances)) {
            throw new RuntimeException('instance for class: ' . $class . ' already exists');
        }

        self::$instances[$class] = $instance;
    }
}

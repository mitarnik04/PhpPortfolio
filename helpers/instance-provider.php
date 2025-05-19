<?php

/**
 * @template T
 */
class InstanceProvider
{
    /**
     * @var array<class-string, object>
     */
    private static array $instances = [];


    /**
     * @template TClass of object
     * @param class-string<TClass> $class
     * @return TClass
     */
    public static function get(string $class): mixed
    {

        if (!array_key_exists($class, self::$instances)) {
            throw new RuntimeException('No instance present for class: ' . $class);
        }

        return self::$instances[$class];
    }

    /**
     * @param class-string $class
     * @param object $instance
     */
    public static function add(string $class, mixed $instance): void
    {
        if (!($instance instanceof $class)) {
            throw new RuntimeException("Instance is not of type: $class");
        }

        if (array_key_exists($class, self::$instances)) {
            throw new RuntimeException("instance for class: $class already exists");
        }

        self::$instances[$class] = $instance;
    }
}

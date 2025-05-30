<?php

/**
 * @template T
 */
class InstanceProvider
{
    /**
     * @var array<class-string, object>
     */
    private array $instances = [];


    /**
     * @template TClass of object
     * @param class-string<TClass> $class
     * @return TClass
     */
    public function get(string $class): mixed
    {

        if (!array_key_exists($class, $this->instances)) {
            throw new RuntimeException('No instance present for class: ' . $class);
        }

        return $this->instances[$class];
    }

    /**
     * @param class-string $class
     * @param object $instance
     */
    public function add(string $class, mixed $instance): void
    {
        if (!($instance instanceof $class)) {
            throw new RuntimeException("Instance is not of type: $class");
        }

        if (array_key_exists($class, $this->instances)) {
            throw new RuntimeException("instance for class: $class already exists");
        }

        $this->instances[$class] = $instance;
    }
}

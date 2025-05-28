<?php

class Test
{
    public array $args;

    /** @param callable(...$args): mixed $testCallable */
    public function __construct(
        public readonly string $name,
        public $testCallable,
        ...$args
    ) {
        $this->args = $args;
    }
}

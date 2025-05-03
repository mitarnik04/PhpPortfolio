<?php

interface IComponentOptions
{
    /**
     * @return array<string, mixed> Associative array of configuration options
     */
    function getAllOptions(): array;
}

interface IComponent
{

    function render(IComponentOptions $options): void;
}

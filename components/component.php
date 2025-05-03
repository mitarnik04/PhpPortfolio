<?php

interface IComponentOptions
{

    function getAllOptions(): array;
}

interface IComponent
{

    function render(IComponentOptions $options);
}

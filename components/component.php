<?php

interface IComponentOptions {}

interface IComponent
{
    function render(IComponentOptions $options): void;
}

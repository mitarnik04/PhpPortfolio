<?php
require_once DIR_HELPERS . '/translator.php';
require_once DIR_HELPERS . '/router.php';
require_once DIR_HELPERS . '/container.php';
require_once DIR_HELPERS . '/metadata.php';


function buildContainer(): Container
{
    $container = new Container();

    $container->add(
        Router::class,
        Router::initialize(Metadata::getLoadableViews(), 'home', fn($pageName) => __DIR__ . '/views/' . $pageName . '.php')
    );

    $container->add(
        Translator::class,
        new Translator(fn($language) => __DIR__ . '/translations/' . $language . '.json')
    );

    return $container;
}

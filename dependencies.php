<?php
require_once DIR_HELPERS . '/translator.php';
require_once DIR_HELPERS . '/router.php';
require_once DIR_HELPERS . '/instance-provider.php';
require_once DIR_HELPERS . '/metadata.php';


function buildInstanceProvider(): InstanceProvider
{
    $instanceProvider = new InstanceProvider();

    $instanceProvider->add(
        Router::class,
        Router::initialize(Metadata::getLoadableViews(), 'home', fn($pageName) => __DIR__ . '/views/' . $pageName . '.php')
    );

    $instanceProvider->add(
        Translator::class,
        new Translator(fn($language) => __DIR__ . '/translations/' . $language . '.json')
    );

    return $instanceProvider;
}

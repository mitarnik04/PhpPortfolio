<?php
define('DIR_COMPONENTS', __DIR__ . '/components');
define('DIR_HELPERS', __DIR__ . '/helpers');
define('DIR_VALIDATORS', __DIR__ . '/validators');

require_once DIR_HELPERS . '/instance-provider.php';
require_once DIR_HELPERS . '/router.php';
require_once DIR_HELPERS . '/metadata.php';

InstanceProvider::add(
    Router::class,
    Router::initialize(Metadata::getLoadableViews(), 'home', fn($pageName) => __DIR__ . '/views/' . $pageName . '.php')
);

class Something {}

require_once DIR_HELPERS . '/translation.php';

InstanceProvider::add(
    Translation::class,
    new Translation(fn($language) => __DIR__ . '/translations/' . $language . '.json')
);

require_once __DIR__ . '/core.php';

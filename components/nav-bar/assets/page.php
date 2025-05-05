<?php

class PageOptionsFacotry
{

    private static array $configuration = [];

    public static function fromJsonConfig(string $pageName): PageOptions
    {
        require_once __DIR__ . '/../../../helpers/utils.php';

        if (!self::tryGetOrLoadConfig()) {
            throw new RuntimeException("config file could not be loaded correctly");
        }

        $pageConfig = self::$configuration[strtoupper($pageName)];
        return new PageOptions($pageConfig["ORDER"], $pageConfig["MATERIAL_ICON_NAME"] ?? '');
    }

    private static function tryGetOrLoadConfig(): bool
    {
        if (!tryGetJsonContent(__DIR__ . '/../configs/page-config.json', self::$configuration)) {
            error_log("No config file present for PageOptions");
            return false;
        }

        return true;
    }
}


class PageOptions
{
    public function __construct(
        public readonly int $order,
        public readonly string $materialIconName = '',
    ) {}
}


class Page
{
    public function __construct(
        public string $path,
        public string $label,
        string $pageName,
        public ?PageOptions $options = null,
    ) {
        if (empty($options)) {
            $options = PageOptionsFacotry::fromJsonConfig($pageName);
        }
    }
}

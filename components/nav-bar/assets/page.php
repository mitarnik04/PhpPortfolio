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
        if (!tryGetJsonContent(__DIR__ . '/../configs/page-options-config.json', self::$configuration)) {
            error_log("No config file present for PageOptions");
            return false;
        }

        return true;
    }
}


class PageOptions
{
    public readonly int $order;
    public readonly string $materialIconName;

    public function __construct(int $order, string $materialIconName = '')
    {
        $this->order = $order;
        $this->materialIconName = $materialIconName;
    }
}


class Page
{
    public string $path;
    public string $label;
    public PageOptions $options;

    public function __construct(string $path, string $label, string $pageName, ?PageOptions $options = null)
    {
        $this->path = $path;
        $this->label = $label;
        if (empty($options)) {
            $options = PageOptionsFacotry::fromJsonConfig($pageName);
        }
        $this->options = $options;
    }
}

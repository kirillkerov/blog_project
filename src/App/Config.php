<?php

namespace App;

final class Config
{
    private static $instance;
    private array $configurations = [];

    protected function __construct()
    {
        $this->load();
    }

    public static function getInstance() : Config
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function load()
    {
        $configFiles = array_diff(scandir(CONFIG_DIR), ['.', '..']);

        foreach ($configFiles as $file) {
            $this->configurations[basename($file, '.php')] = require CONFIG_DIR . $file;
        }
    }

    public function get(string $config, $default = null)
    {
        return array_get($this->configurations, $config) ?? $default;
    }
}

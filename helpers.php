<?php

use App\Formatters\StrToDate;

function formatDate(string $date)
{
    return StrToDate::format($date);
}

function dd(...$params)
{
    echo '<pre>';
    var_dump($params);
    echo '</pre>';
    die;
}

function dump(...$params)
{
    echo '<pre>';
    var_dump($params);
    echo '</pre>';
}

function array_get(array $array, string $key, $default = null)
{
    $keys = explode('.', $key);

    $result = $array;
    foreach ($keys as $key) {
        if (is_array($result) && array_key_exists($key, $result)) {
            $result = $result[$key];
        } else {
            return $default;
        }
    }

    return $result;
}

function correctConfig($configName, $configValue)
{
    $config = file(CONFIG_DIR . 'config.php');
    foreach ($config as $lineNumber => $lineValue) {
        if (strpos($lineValue, $configName)) {
            $config[$lineNumber] = '    "' . $configName . '" => ' . $configValue . ',' . PHP_EOL;
        }
    }
    file_put_contents(CONFIG_DIR . 'config.php', $config);
}

<?php

declare(strict_types=1);

namespace webignition\SymfonyPantherWebServerRunner;

class Options
{
    public const DEFAULT_HOSTNAME = '127.0.0.1';
    public const DEFAULT_PORT = 9080;

    /**
     * @var array<string, int|string>
     */
    private static $default = [
        'hostname' => self::DEFAULT_HOSTNAME,
        'port' => self::DEFAULT_PORT,
    ];

    /**
     * @var array<string, int|string>
     */
    private static $options = null;

    /**
     * @return array<string, int|string>
     */
    public static function getDefault(): array
    {
        return self::$default;
    }

    /**
     * @return array<string, int|string>
     */
    public static function get(): array
    {
        if (null === self::$options) {
            self::$options = self::$default;
        }

        return self::$options;
    }

    /**
     * @param array<string, int|string> $options
     */
    public static function set(array $options): void
    {
        self::$options = array_merge(self::$options, $options);
    }

    public static function getBaseUri(): string
    {
        $options = self::get();

        return sprintf('http://%s:%s', $options['hostname'], $options['port']);
    }
}

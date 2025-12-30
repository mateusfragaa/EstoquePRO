<?php
namespace App\Core;

abstract class Request
{
    private static string $controller;
    private static string $metodo;
    private static int $id;

    public static function preencherAttr(string $url): void
    {
        $url = parse_url($url, PHP_URL_PATH);

        $partes = explode('/', trim($url, '/'));
        self::$controller = $partes[0] ?? '';
        self::$metodo     = $partes[1] ?? '';
        self::$id         = isset($partes[2]) ? (int)$partes[2] : 0;
    }

    public static function getController(): string
    {
        return self::$controller;
    }

    public static function getMetodo(): string
    {
        return self::$metodo;
    }

    public static function getId(): int
    {
        return self::$id;
    }
}

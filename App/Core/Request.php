<?php
namespace App\Core;

class Request
{
    private string $controller;
    private string $metodo;
    private int $id;

    public function preencherAttr(string $url): void
    {
        $url = parse_url($url, PHP_URL_PATH);

        $partes = explode('/', trim($url, '/'));
        $this->controller = $partes[0] ?? '';
        $this->metodo     = $partes[1] ?? '';
        $this->id         = isset($partes[2]) ? (int)$partes[2] : 0;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getMetodo(): string
    {
        return $this->metodo;
    }

    public function getId(): int
    {
        return $this->id;
    }
}

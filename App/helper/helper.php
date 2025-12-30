<?php
/**
 * Fazer a requisição de components
 * @param string $arquivo - nome do arquivo
 */
function components(string $arquivo) :void
{
    if(PATH_BASE."/App/View/components/$arquivo.phtml"){
        require_once PATH_BASE."/App/View/components/$arquivo.phtml";
    }
}

/**
 * Fazer o uso de valores nas sessões e destrui-lós em seguida
 *  @param string $key - nome do índice
 */
function session(string $key) :mixed
{
    if (isset($_SESSION[$key])) {
        $valor = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $valor;
    }
    return false;
}

/**
 * Fazer o uso de valores nas sessões e destrui-lós em seguida
 *  @param string $key - nome do índice
 */
function getGet(string $key) : mixed
{
    if (isset($_GET[$key])) {
        $valor = $_GET[$key];
        //unset($_GET[$key]);
        return $valor;
    }
    return false;
}

/**
 * Fazer o uso de valores nas sessões e destrui-lós em seguida
 *  @param string $key - nome do índice
 */
function getPost(string $key) : mixed
{
    if (isset($_POST[$key])) {
        $valor = $_POST[$key];
        //unset($_GET[$key]);
        return $valor;
    }
    return false;
}

<?php 
namespace App\Core;

class Ambiente{
    public static function load()
    {
        // Análisa e carrega as variáveis do arquivo .env em um array
        $confAmbiente = parse_ini_file(PATH_BASE."/.env", true);

        // Faz a troca de ambiente de produção para desenvolvimento, por que no arquivo env são sessões que separam e sendo sesssões não possuem array, Pega o nome da sessão
        foreach ($confAmbiente as $key => $value) {
            if (!is_array($value)) {
                $_ENV[$key] = $value;
            }
        }

        // Carrega os valores do índice específicado
        if (isset($_ENV['ENVIRONMENT'])) {
            foreach ($confAmbiente[$_ENV['ENVIRONMENT']] as $key => $value) {
                $_ENV[$key] = $value;
            }
        }
        return null;
    }
}
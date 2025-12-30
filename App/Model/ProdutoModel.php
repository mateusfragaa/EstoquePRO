<?php
namespace App\Model;
use MF\Model\Model;
use Exception;
// Vai herdar de DataBase os comandos sql 

class ProdutoModel extends Model
{   
    // Como não tem construtor próprio o php busca o construtor da super classe deixando o acessível na classe Model e Model acessível a Eloquent
    protected string $tabela = 'produto';

    public function cadastroProduto(array $post) : array
    {   
        if ($this->validarDados($post)) {
            return $this->procedureSP(
                'insere_atualiza_produto',
                [
                    '-1',
                    $post['produto'],
                    $post['ncm'],
                    $post['categoria'],
                    $post['grupo'],
                    $post['setor'],
                    $post['status']
                ]);
        }
        return [];
    }

    public function validarDados(array $post) :bool
    {   
        $retorno = true;
        if ( !isset($post['produto']) || strlen(trim($post['produto'])) < 3 || strlen(trim($post['produto'])) > 255) {
            $retorno = false;
            throw new Exception("Nome do produto está inválido para cadastro");
        }
        if ( !isset($post['ncm']) || strlen(trim($post['ncm'])) != 8 ) {
            $retorno = false;
            throw new Exception("Ncm do produto está inválido para cadastro ");
        }
        if ( !isset($post['categoria']) || !is_numeric($post['categoria']) || (int)$post['categoria'] < 1  ) {
            $retorno = false;
            throw new Exception("Categoria do produto está inválido para cadastro");
        }
        if ( !isset($post['grupo']) || !is_numeric($post['grupo']) || (int)$post['grupo'] < 1  ) {
            $retorno = false;
            throw new Exception("Grupo do produto está inválido para cadastro");
        }
        if ( !isset($post['setor']) || !is_numeric($post['setor']) || (int)$post['setor'] < 1  ) {
            $retorno = false;
            throw new Exception("Setor do produto está inválido para cadastro");
        }
        if ( !isset($post['status']) || !is_numeric($post['status']) || (int)$post['status'] < 1  ) {
            $retorno = false;
            throw new Exception("Status do produto está inválido para cadastro");
        }
        
        return $retorno;
    }
}
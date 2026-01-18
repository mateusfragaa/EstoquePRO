<?php
namespace App\Model;

use MF\Model\Model;
use Exception;
class EstoqueModel extends Model
{
    protected string $tabela = 'setor_produto';

    public function setorProdutos(int $idSetor) :array
    {
        return $this->select([
            'SETOR_ESTOQUE_ID as codigo','SP_PRODUTO_ID AS PRODUTO_ID','PRD_NOME','SP_SETOR_ID AS SETOR_ID','STR_NOME','SP_QUANTIDADE_ATUAL','SP_QUANTIDADE_MAXIMA','SP_QUANTIDADE_MINIMA','SP_PRODUTO_CUSTO_MEDIO','SP_PRECO_CUSTO','SP_PRECO_VENDA','SP_PRODUTO_LOCAL_INTERNO'
        ])
        ->join([['inner','produto','setor_produto.SP_PRODUTO_ID','produto.PRODUTO_ID'],
            ['inner','setor','setor_produto.SP_SETOR_ID','setor.SETOR_ID']
        ])->where([['setor_produto.SP_SETOR_ID','=',$idSetor,'']])->execute();
    }

    public function cadastrar($post) :array
    {
        if ($this->validarDados($post)) {
            return $this->procedureSP(
                'cadastrar_produto_setor',
                [
                    $post['produto'],
                    $post['setor'],
                    $post['qtdAtual'],
                    $post['qtdMax'],
                    $post['qtdMin'],
                    $post['precoCusto'],
                    $post['precoVenda'],
                    $post['ref']
                ]);
        }
        return [];
    }

    public function editar(array $post,int $id) :array
    {
        var_dump($post,$id);
        if ($this->validarDados($post)) {
            return $this->procedureSP(
                'editar_produto_setor',
                [   
                    $id,
                    $post['produto'],
                    $post['setor'],
                    $post['qtdAtual'],
                    $post['qtdMax'],
                    $post['qtdMin'],
                    $post['precoCusto'],
                    $post['precoVenda'],
                    $post['ref']
                ]);
        }
        return [];
    }

    public function validarDados(array $post) :bool
    {
        
        $retorno = true;
        if ( !isset($post['produto']) || !is_numeric($post['produto'])) {
            $retorno = false;
            throw new Exception("Identificador do produto está inválido para cadastro");
        }
        if ( !isset($post['setor']) || !is_numeric($post['setor']) ) {
            $retorno = false;
            throw new Exception("Identificador do setor está inválido para cadastro");
        }
        if ( !isset($post['qtdAtual']) || !is_numeric($post['qtdAtual']) || (int)$post['qtdAtual'] < 0  ) {
            $retorno = false;
            throw new Exception("Quantidade atual está inválida para cadastro");
        }
        if ( !isset($post['qtdMax']) || !is_numeric($post['qtdMax']) || (int)$post['qtdMax'] <  (int)$post['qtdAtual']) {
            $retorno = false;
            throw new Exception("Quantidade máxima está inválida para cadastro");
        }
        if ( !isset($post['qtdMin']) || !is_numeric($post['qtdMin']) || (int)$post['qtdMin'] < 1 ||  (int)$post['qtdMin'] >  (int)$post['qtdMax'] ) {
            $retorno = false;
            throw new Exception("Quantidade mínima está inválida para cadastro");
        }
        if ( !isset($post['precoCusto']) || !is_numeric($post['precoCusto']) || (int)$post['precoCusto'] < 0 ||  (int)$post['precoCusto'] >  (int)$post['precoVenda'] ) {
            $retorno = false;
            throw new Exception("Preço de custo está inválido para cadastro");
        }

        if ( !isset($post['precoVenda']) || !is_numeric($post['precoVenda']) || (int)$post['precoVenda'] < 0 ||  (int)$post['precoCusto'] >  (int)$post['precoVenda'] ) {
            $retorno = false;
            throw new Exception("Preço de venda está inválido para cadastro");
        }

        return $retorno;
    }
}

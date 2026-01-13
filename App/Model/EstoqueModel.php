<?php
namespace App\Model;

use MF\Model\Model;

class EstoqueModel extends Model
{
    protected string $tabela = 'setor_produto';

    public function setorProdutos(int $idSetor):array
    {
        return $this->select([
                        'SP_PRODUTO_ID AS PRODUTO_ID','PRD_NOME','SP_SETOR_ID AS SETOR_ID','STR_NOME','SP_QUANTIDADE_ATUAL','SP_QUANTIDADE_MAXIMA','SP_QUANTIDADE_MINIMA','SP_PRODUTO_CUSTO_MEDIO','SP_PRECO_CUSTO','SP_PRECO_VENDA','SP_PRODUTO_LOCAL_INTERNO'
                    ])
                    ->join([['inner','produto','setor_produto.SP_PRODUTO_ID','produto.PRODUTO_ID'],
                            ['inner','setor','setor_produto.SP_SETOR_ID','setor.SETOR_ID']
                        ])->where([['setor_produto.SP_SETOR_ID','=',$idSetor,'']])->execute();
    }
}

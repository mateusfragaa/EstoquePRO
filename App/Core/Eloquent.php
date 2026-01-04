<?php
namespace App\Core;
use PDO;
abstract class Eloquent{
    private PDO $conexao;
    private string $tabela;
    private array $selectData = [];
    private array $whereData = [];
    private array $bindsParam = [];

    public function __construct(PDO $conexao, string $tabela)
    {   
        $this->conexao = $conexao;
        $this->tabela = strtolower($tabela);
    }


    public function createParam(string $param) :string
    {   
        $temp = uniqid(':');
        $this->bindsParam[$temp] = $param;
        return $temp;
    }

    public function clearArray() :void
    {
        $this->bindsParam = [];
        $this->selectData = [];
        $this->whereData  = [];
    }

    /**
    * Função depende da boa prática de ordem de parâmetros das procedures in,out e depois o inout
    * Passar o $dados somente se a procedure tiver parâmetros e se tiver passar o $dados em formato de array comum com as  *variáveis out e inout já no formato @nome padrão das variáveis do sql
    * $this->procedureSP('soma',['1','2','@resultado']);
    * @param string $procedure
    * @param array $dados
    * @return array
    */
    public function procedureSP(string $procedure, array $dados = []) : array
    {   
        $paramentro = [];
        $sql = "call {$procedure}(";
        foreach ($dados as $key => $value) {
            if (!str_contains($value, '@')) {
                array_push($paramentro, ":$key");
            }else{
             array_push($paramentro, $value);
            }
        }
         $sql .= implode(',',$paramentro);
         $stmt = $this->conexao->prepare($sql.')');
         foreach ($dados as $key => $value) {
            if (!str_contains($value, '@')) {
                $stmt->bindValue(":$key",$value);
            }
        }

         $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca um registro com base em um dado
     * firstOrFail(coluna_id, 2);
     * @param string $coluna - nome da coluna
     * @param float | int |string $value - valor a ser comparado
     * @return bool | array
     */
    public function firstOrFail(string $coluna, float | int | string $value) :bool|array
    {
        return $this->select()->where([[$coluna,'=',$value,'']])->execute(false);
    }

    /**
     * Deve receber strings como valores do array (nome colunas)
     * ['coluna_1','coluna_2'];
     * @param array $colunas 
     * @return objeto
     */
    public function select(array $columns = ['*']) :object
    {   
        $column = implode(', ',$columns);
        array_push($this->selectData, "SELECT $column FROM $this->tabela");
        return $this;
    }

    /**
     * Deve receber strings como valores do array (nome colunas)
     * ['coluna_1','coluna_2'];
     * @param array $colunas 
     * @return objeto
     */
    public function selectView(string $view) :object
    {   
        array_push($this->selectData, "SELECT * FROM $view");
        return $this;
    }

    /**
     * Deve receber string como valores do array interno encapsulado por um array externo array de arrays, para cada Join deve-se     * criar um array interno
     * Fazendo 1 Join -> [['tipo join','tabela add','idTblModel','idTblAdd']];
     * Fazendo 2 Join -> [['tipo join','tabela add','idTblModel','idTblAdd'], ['tipo join','tabela add','idTblModel','idTblAdd']];
     * @param array de array $join
     * @return objeto
     */
    public function join(array $join) :object
    {
        $sql = "";
        foreach($join as $key => $value){
            $sql .= "$value[0] JOIN $value[1] ON $value[2] = $value[3]".PHP_EOL;
        }
        array_push($this->selectData,$sql);
        return $this;
    }

    /**
     * Deve receber string como valores do array interno encapsulado por um array externo array de arrays, para cada where deve-se  criar um array interno
     * Fazendo 1 Where -> [['coluna1 ou valor1','operador','coluna2 ou valor2','condicional ou "" ']];
     *                     where [0]saldo [1]> [2]divida [3]and
     * Fazendo 2 Where -> [
     *                      ['coluna1 ou valor1','operador','coluna2 ou valor2','condicional ou "" '],
     *                      ['coluna3 ou valor3','operador','coluna4 ou valor4','condicional ou "" ']
     *                    ];
     * Operador [<, >, <=, >=, ==, != ], Condicionais[ and, or]
     * Pode ser usado também o like no where ex..: where nome % xx %, ou passado em um só índice do array e completando com vazio os outros
     * @param array de array $where
     * @return objeto
     */
    public function where(array $where) :object
    {   
        $sql = 'WHERE ';
        foreach($where as $key => $value){
            $sql .= $value[0]." $value[1] ".$this->createParam($value[2])." $value[3] ".PHP_EOL;
        }
        array_push($this->selectData,$sql);
        return $this;
    }

    /**
     * Deve receber uma string com o nome coluna das colunas e o formato de um group by válido
     * Ex..: coluna1 asc, coluna 2 desc coluna3
     * @param string $groupBy
     * @return objeto
     */
    public function groupBy(string $groupBy) :object
    {   
        $sql = 'GROUP BY'. $groupBy;
        array_push($this->selectData,$sql);
        return $this;
    }

    /**
     * Deve receber string como valores do array interno encapsulado por um array externo array de arrays, para cada Having deve-se  criar um array interno
     * Fazendo 1 Having -> [['coluna1 ou valor1','operador','coluna2 ou valor2','condicional ou "" ']];
     * Fazendo 2 Having -> [
     *                      ['coluna1 ou valor1','operador','coluna2 ou valor2','condicional ou "" '],
     *                      [''coluna3 ou valor3','operador','coluna4 ou valor4','condicional ou "" ']
     *                    ];
     * Operador [<, >, <=, >=, ==, != ], Condicionais[ and, or]
     * @param array  $where - array de array
     * @return object
     */
    public function having(array $having) :object
    {   
        $sql = "HAVING";
        foreach($having as $key => $value){
            $sql .= " $value[0] $value[1] $value[2] $value[3]".PHP_EOL;
        }
        array_push($this->selectData,$sql);
        return $this;
    }

    /**
     * Deve receber uma string com o nome coluna das colunas e o formato de um order by válido
     * Ex..: coluna1, coluna2
     * @param string $groupBy
     * @return object
     */
    public function orderBy(string $orderBy) :object
    {   
        $sql = 'ORDER BY'. $orderBy;
        array_push($this->selectData,$sql);
        return $this;
    }

    /**
     * Por padrão retorna um fetchAll mas quando e passado $retorno false, faz o retorno de um fetch
     * @param boll $retorno
     * @return array | bool
     * */
    public function execute(bool $retorno = true) :array | bool
    {
        $sql = implode(' '.PHP_EOL,$this->selectData);
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($this->bindsParam);
        $this->clearArray();
        return ($retorno) ?  $stmt->fetchAll() :  $stmt->fetch();
    }

    /**
     * @param array $data
     * @return void
     */
    public function insert(array $data) :void
    {       
        $placeholders = ":".implode(',:', array_keys($data));
        $colunas = implode(',', array_keys($data));
        $stmt = $this->conexao->prepare("insert into {$this->tabela}($colunas) values($placeholders)");
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
    }

    /**
     * @param array $data
     * @param string $campoId
     * @param int $id
     * @return void
     */
    public function update(array $data,string $campoId, int $id) :void
    {
        $arrayChaves = array_keys($data);
        $preparoQuery = array_map(function($x){
            return "$x = :$x";
        }, $arrayChaves);
        $colunaValor = implode(', ',$preparoQuery);
        $stmt = $this->conexao->prepare("update {$this->tabela} set $colunaValor where {$campoId} = :id");
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    /**
     * @param string $campoId
     * @param int $id
     */
    public function delete(string $campoId, int $id) :void
    {
        $stmt = $this->conexao->prepare("delete from {$this->tabela} where {$campoId} = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
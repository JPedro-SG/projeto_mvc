<?php
class Pagamento
{
    private $atributos;

    public function __construct()
    {
    }

    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
    }

    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }

    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }

    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT p.idPagamento, p.idEstagiario, p.data, p.valorPago, p.descricao, e.nome FROM pagamento AS p JOIN estagiario AS e ON e.idEstagiario = p.idEstagiario;");
        $result = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Pagamento::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }

        return false;
    }

    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'" . addslashes(strval($dados)) . "'";
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return 'NULL';
        }
    }


    private function preparar($dados)
    {
        $resultado = array();
        foreach ($dados as $k => $v) {
            if (is_scalar($v)) {
                $resultado[$k] = $this->escapar($v);
            }
        }
        return $resultado;
    }

    public function save()
    {

        $colunas = $this->preparar($this->atributos);
        if (!isset($this->idPagamento)) {
            $query = "INSERT INTO pagamento (" .
                implode(', ', array_keys($colunas)) .
                ") VALUES (" .
                implode(', ', array_values($colunas)) . ");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'idPagamento') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE pagamento SET " . implode(', ', $definir) . " WHERE idPagamento='{$this->idPagamento}';";
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }
        return false;
    }

    public static function find($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM pagamento WHERE idPagamento='{$id}';");

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('Pagamento');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }

    public static function destroy($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM pagamento WHERE idPagamento='{$id}';")) {
            return true;
        }
        return false;
    }
}

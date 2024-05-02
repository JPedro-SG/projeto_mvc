<?php

class Projeto
{
    private $atributos;

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

    /**
     * Retorna uma lista de projetos
     * @return array/boolean
     */

    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM projeto;");
        $result = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Projeto::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }

        return false;
    }

    /**
     * Tornar valores aceitos para sintaxe SQL
     * @param type $dados
     * @return string
     */
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

    /**
     * Verifica se dados são próprios para ser salvos
     * @param array $dados
     * @return array
     */
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

    /**
     * Encontra um recurso pelo id
     * @param type $id
     * @return type
     */
    public static function find($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM projeto WHERE idProjeto='{$id}';");

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('Projeto');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }

    /**
     * Salvar o projeto
     * @return boolean
     */
    public function save()
    {

        $colunas = $this->preparar($this->atributos);
        if (!isset($this->idProjeto)) {
            $query = "INSERT INTO projeto (" .
                implode(', ', array_keys($colunas)) .
                ") VALUES (" .
                implode(', ', array_values($colunas)) . ");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'idProjeto') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE projeto SET " . implode(', ', $definir) . " WHERE idProjeto='{$this->idProjeto}';";
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }
        return false;
    }

    public static function destroy($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM projeto WHERE idProjeto='{$id}';")) {
            return true;
        }
        return false;
    }

    public static function allInternsInProject($id)
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM projetoEstagiario where idProjeto = '{$id}';");
        $result = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Projeto::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }

        return false;
    }

    public function saveInternInProject($dados)
    {
        $colunas = $this->preparar($dados);

        if (!isset($dados->idProjeto)) {
            $query = "INSERT INTO projetoEstagiario (" .
                implode(', ', array_keys($colunas)) .
                ") VALUES (" .
                implode(', ', array_values($colunas)) . ");";
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }
        return false;
    }

    public static function removeFromProject($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM projetoEstagiario WHERE idProjetoEstagiario='{$id}';")) {
            return true;
        }
        return false;
    }

    public static function deleteAllInternsFromProject($id) {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM projetoEstagiario WHERE idProjeto='{$id}';")) {
            return true;
        }
        return false;
    }

    

}

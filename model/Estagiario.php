<?php

class Estagiario
{
    private $atributos;

    public function __construct()
    {
    }

    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
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
     * Retorna uma lista de estagiarios
     * @return array/boolean
     */

    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM estagiario;");
        $result = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Estagiario::class)) {
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
        $stmt    = $conexao->prepare("SELECT * FROM estagiario WHERE idEstagiario='{$id}';");

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('Estagiario');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }

    /**
     * Salvar o estagiário
     * @return boolean
     */
    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        if (!isset($this->idEstagiario)) {
            $query = "INSERT INTO estagiario (" .
                implode(', ', array_keys($colunas)) .
                ") VALUES (" .
                implode(', ', array_values($colunas)) . ");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'idEstagiario') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE estagiario SET " . implode(', ', $definir) . " WHERE idEstagiario='{$this->idEstagiario}';";
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }
        return false;
    }

    /**
     * Destruir um recurso
     * @param type $id
     * @return boolean
     */
    public static function destroy($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM estagiario WHERE idEstagiario='{$id}';")) {
            return true;
        }
        return false;
    }

    /**
     * Retorna uma lista de estagiários que fazem parte de um projeto (Sem repetição)
     * @return array/boolean
     */

    public static function listInternsInProjects()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT DISTINCT e.idEstagiario, nome FROM projetoEstagiario as pe JOIN estagiario AS e ON e.idEstagiario = pe.idEstagiario;");
        $result = array();
       
        if ($stmt->execute()) {
            while($rs = $stmt->fetchObject(Estagiario::class)) {
                $result[] = $rs;
            }
        }

        if (count($result) > 0) {
            return $result;
        }
        
        return false;
    }
}

<?php
class FTPConexao
{
    private static $conexao;
    private static $servidor = "127.0.0.1";
    private static $usuario = "projeto_mvc";
    private static $senha = "dgcs9922";
    // private $dirRemoto = "/Download/";


    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$conexao)) {
            self::$conexao = ftp_connect(self::$servidor) or die("Não foi possível conectar ao servidor FTP");
            ftp_login(self::$conexao, self::$usuario, self::$senha);
            ftp_pasv(self::$conexao, true);
        }

        return self::$conexao;
    }

    public function __destruct() {
        // Fechar conexão FTP
        ftp_close($this->conexao);
    }

    
}

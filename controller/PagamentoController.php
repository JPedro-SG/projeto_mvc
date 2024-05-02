<?php

class PagamentoController extends Controller
{
    public function listar()
    {

        $pagamentos = Pagamento::all();
        return $this->view('view/pagamentoGrade', ['pagamentos' => $pagamentos]);
    }

    public function criar()
    {
        $estagiarios = Estagiario::listInternsInProjects();
        return $this->view('view/pagamentoForm', ['estagiarios' => $estagiarios]);
    }

    public function salvar()
    {

        $pagamento           = new Pagamento;
        $pagamento->idEstagiario     = $this->request->idEstagiario;
        $pagamento->data     =  date('Y-m-d H:i:s');
        $pagamento->valorPago = $this->request->valorPago;
        $pagamento->descricao = $this->request->descricao;
        if ($pagamento->save()) {

            $idPagamento =  Conexao::getInstance()->lastInsertId();



            
            if ($_FILES["arquivo"]["name"]) {
                $ftp = FTPConexao::getInstance();
                if (ftp_put($ftp, "/Downloads/" . $_FILES["arquivo"]["name"], $_FILES["arquivo"]["tmp_name"], FTP_BINARY)) {
                    $anexo = new Anexo;
                    $anexo->idPagamento = $idPagamento;
                    $anexo->arquivo = "/Downloads/" . $_FILES["arquivo"]["name"];
                    $anexo->descricao = $this->request->descricaoArquivo;
                    $anexo->save();
                } else {
                    echo "Falha ao enviar o arquivo.";
                }
            }




            return $this->listar();
        }
    }

    public function atualizar($dados)
    {
        $id                = (int) $dados['id'];
        $pagamento           = Pagamento::find($id);
        $pagamento->idEstagiario     = $this->request->idEstagiario;
        $pagamento->data     =  date('Y-m-d H:i:s');
        $pagamento->valorPago = $this->request->valorPago;
        $pagamento->descricao = $this->request->descricao;

        if ($pagamento->save()) {
            $ftp = FTPConexao::getInstance();
            if (ftp_put($ftp, "/Downloads/" . $_FILES["arquivo"]["name"], $_FILES["arquivo"]["tmp_name"], FTP_BINARY)) {
                $idAnexo = (int) $dados['idAnexo'];
                $anexo = Anexo::find($idAnexo);
                if ($_FILES["arquivo"]["name"]) {
                    $anexo->arquivo = "/Downloads/" . $_FILES["arquivo"]["name"];
                }
                $anexo->descricao = $this->request->descricaoArquivo;
                $anexo->save();
            }
        }


        return $this->listar();
    }

    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $pagamento = Pagamento::find($id);
        $anexo = Anexo::findByPayment($id);
        $estagiarios = [Estagiario::find((int) $pagamento->idEstagiario)];

        return $this->view('view/pagamentoForm', ['pagamento' => $pagamento, 'estagiarios' => $estagiarios, 'anexo' => $anexo]);
    }

    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $anexo = Anexo::destroyByPaiment($id);
        $projeto = Pagamento::destroy($id);
        return $this->listar();
    }
}

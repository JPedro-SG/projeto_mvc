<?php

class EstagiarioController extends Controller
{

    public function listar()
    {
        $estagiarios = Estagiario::all();
        return $this->view('view/estagiarioGrade', ['estagiarios' => $estagiarios]);
    }

    /**
     * Mostrar formulario para criar um novo estagiario
     */
    public function criar()
    {
        return $this->view('view/estagiarioForm');
    }

    /**
     * Salvar o contato submetido pelo formulário
     */
    public function salvar()
    {
        $estagiario           = new Estagiario;
        $estagiario->nome     = $this->request->nome;
        $estagiario->telefone = $this->request->telefone;
        $estagiario->valorBolsa = $this->request->valorBolsa;
        $estagiario->auxilio = $this->request->auxilio;
        $estagiario->email    = $this->request->email;
        $estagiario->usuario    = $this->request->usuario;
        $estagiario->senha    = $this->request->senha;
        $estagiario->dadosBancario    = $this->request->dadosBancario;
        $estagiario->endereco    = $this->request->endereco;

        if ($estagiario->save()) {
            return $this->listar();
        }
    }

    /**
     * Mostrar formulário para editar um estagiario
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $estagiario = Estagiario::find($id);

        return $this->view('view/estagiarioForm', ['estagiario' => $estagiario]);
    }

    /**
     * Atualizar o estagiario conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id                = (int) $dados['id'];
        $estagiario           = Estagiario::find($id);
        $estagiario->nome     = $this->request->nome;
        $estagiario->telefone = $this->request->telefone;
        $estagiario->valorBolsa = $this->request->valorBolsa;
        $estagiario->auxilio = $this->request->auxilio;
        $estagiario->email    = $this->request->email;
        $estagiario->usuario    = $this->request->usuario;
        $estagiario->senha    = $this->request->senha;
        $estagiario->dadosBancario    = $this->request->dadosBancario;
        $estagiario->endereco    = $this->request->endereco;
        $estagiario->save();

        return $this->listar();
    }

    /**
     * Apagar um estagiario conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $estagiario = Estagiario::destroy($id);
        return $this->listar();
    }
}

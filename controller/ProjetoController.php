<?php

class ProjetoController extends Controller
{
    public function listar()
    {
        $projetos = Projeto::all();
        return $this->view('view/projetoGrade', ['projetos' => $projetos]);
    }

    /**
     * Mostrar formulario para criar um novo projeto
     */
    public function criar()
    {
        return $this->view('view/projetoForm');
    }

    public function salvar()
    {
        $projeto           = new Projeto;
        $projeto->nome     = $this->request->nome;
        $projeto->companhia     = $this->request->companhia;
        $projeto->descricao = $this->request->descricao;
        $projeto->dataInicio = $this->request->dataInicio;
        $projeto->dataFim = $this->request->dataFim;


        if ($projeto->save()) {
            return $this->listar();
        }
    }

    public function adicionarEstagiarioAoProjeto($dados) {
        $projeto = new Projeto;
        $dados['dataInicio'] = $this->request->dataInicioModal;
        $dados['dataFim'] = $this->request->dataFimModal;
        $dados['funcao'] = $this->request->funcao;
        $dados['idEstagiario'] = $this->request->idEstagiario;
        if($projeto->saveInternInProject($dados)) {
            $dados['id'] = $dados['idProjeto'];
            $this->editar($dados);
        }
    }

    /**
     * Mostrar formulário para editar um projeto
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $projeto = Projeto::find($id);
        $projetoEstagiario = Projeto::allInternsInProject($id);
        $estagiarios = Estagiario::all();

        return $this->view('view/projetoForm', ['projeto' => $projeto, 'projetoEstagiario' => $projetoEstagiario, 'estagiarios' => $estagiarios]);
    }


    /**
     * Atualizar o projeto conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id                = (int) $dados['id'];
        $projeto           = Projeto::find($id);
        $projeto->nome     = $this->request->nome;
        $projeto->companhia     = $this->request->companhia;
        $projeto->descricao = $this->request->descricao;
        $projeto->dataInicio = $this->request->dataInicio;
        $projeto->dataFim = $this->request->dataFim;

        $projeto->save();

        return $this->listar();
    }

    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        Projeto::deleteAllInternsFromProject($id);
        Projeto::destroy($id);
        return $this->listar();
    }

    public function removerEstagiarioProjeto($dados) {
        $idProjetoEstagiario = (int) $dados['idProjetoEstagiario'];
        
        $projeto = Projeto::removeFromProject($idProjetoEstagiario);
        
        return $this->editar($dados);
    }
}

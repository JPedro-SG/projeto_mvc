<div class="container">
    <form action="?controller=ProjetoController&<?php echo isset($projeto->idProjeto) ? "method=atualizar&id={$projeto->idProjeto}" : "method=salvar"; ?>" method="post">
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title"><?php echo isset($projeto->idProjeto) ? "Editar Projeto" : "Cadastrar Projeto"; ?></span>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nome:</label>
                    <input value="<?php echo isset($projeto->idProjeto) ? $projeto->nome : null; ?>" type="text" class="form-control" name="nome" id="nome">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Companhia:</label>
                    <input value="<?php echo isset($projeto->idProjeto) ? $projeto->companhia : null; ?>" type="text" class="form-control" name="companhia" id="companhia">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Descrição:</label>
                    <input value="<?php echo isset($projeto->idProjeto) ? $projeto->descricao : null; ?>" type="text" class="form-control" name="descricao" id="descricao">
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="recipient-name" class="col-form-label">Data de Inicio:</label>
                        <input value="<?php echo isset($projeto->idProjeto) ? explode(' ', $projeto->dataInicio)[0] : null; ?>" type="date" class="form-control" name="dataInicio" id="dataInicio">
                    </div>
                    <div class="mb-3 col">
                        <label for="recipient-name" class="col-form-label">Data de Termino:</label>
                        <input value="<?php echo isset($projeto->idProjeto) ? explode(' ', $projeto->dataFim)[0] : null; ?>" type="date" class="form-control" name="dataFim" id="dataFim">
                    </div>
                </div>

                <?php
                if (isset($projetoEstagiario)) {
                ?>
                    <div class="mb-2">
                        <span>Estagiários do Projeto</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="top:40px;">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Função</th>
                                    <th>Inicio</th>
                                    <th>Fim</th>
                                    <th><button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success btn-sm">Adicionar</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($projetoEstagiario && $estagiarios) {
                                    foreach ($estagiarios as $estagiario) {
                                        $projEst = array_filter($projetoEstagiario, fn ($item) => $item->idEstagiario === $estagiario->idEstagiario);
                                        $size = count($projEst);

                                        if ($size > 0) {
                                            $pj = reset($projEst);
                                ?>
                                            <tr>
                                                <td><?php echo $estagiario->nome; ?></td>
                                                <td><?php echo isset($pj->funcao) ? $pj->funcao : '-'; ?></td>
                                                <td><?php echo isset($pj->dataInicio) ? $pj->dataInicio : '-'; ?></td>
                                                <td><?php echo isset($pj->dataFim) ? $pj->dataFim : '-'; ?></td>

                                                <td>
                                                    <div class="d-flex">

                                                        <a href="?controller=ProjetoController&method=removerEstagiarioProjeto&idProjetoEstagiario=<?php echo $pj->idProjetoEstagiario; ?>&id=<?php echo $pj->idProjeto; ?>" class="btn btn-danger btn-sm d-block me-1">Excluir</a>



                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5">Nenhum registro encontrado</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


            </div>

            <div class="card-footer d-flex">
                <a href="?controller=ProjetoController&method=listar" class="ms-auto btn btn-secondary">Cancelar</a>
                <button class="ms-2 btn btn-success" type="submit">Salvar</button>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Estagiário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modalForm" name="modalForm" action="?controller=ProjetoController&method=adicionarEstagiarioAoProjeto&idProjeto=<?php echo $projeto->idProjeto; ?>" method="post">
                        <div class="mb-3">
                            <label for="idEstagiario" class="col-form-label">Estagiários:</label>
                            <select id="idEstagiario" name="idEstagiario" class="form-select" aria-label="Default select example">
                                <?php

                                foreach ($estagiarios as $estagiario) {
                                    $size = $projetoEstagiario ? count(array_filter($projetoEstagiario, fn ($item) => $item->idEstagiario === $estagiario->idEstagiario)) : 0;

                                    if ($size === 0) {
                                ?>
                                        <option value="<?php echo $estagiario->idEstagiario; ?>"><?php echo $estagiario->nome ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="funcao" class="col-form-label">Função:</label>
                            <select id="funcao" name="funcao" class="form-select" aria-label="Default select example">

                                <option value="Desenvolvedor">Desenvolvedor</option>
                                <option value="Testador">Testador</option>

                            </select>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="recipient-name" class="col-form-label">Data de Inicio:</label>
                                <input required type="date" class="form-control" name="dataInicioModal" id="dataInicioModal">
                            </div>
                            <div class="mb-3 col">
                                <label for="recipient-name" class="col-form-label">Data de Termino:</label>
                                <input required type="date" class="form-control" name="dataFimModal" id="dataFimModal">
                            </div>
                        </div>
                        <div class="modal-footer d-flex">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
                }
?>
</div>
<h1 class="ps-4 mt-2">Projetos</h1>
<div class="table-responsive">

    <table class="table table-bordered table-striped" style="top:40px;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Inicio</th>
                <th>Fim</th>
                <th>Companhia</th>
                <th><a href="?controller=ProjetoController&method=criar" class="btn btn-success btn-sm">Novo</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($projetos) {
                foreach ($projetos as $projeto) {
            ?>
                    <tr>
                        <td><?php echo $projeto->nome; ?></td>
                        <td><?php echo $projeto->dataInicio ? explode(' ', $projeto->dataInicio)[0] : '-'; ?></td>
                        <td><?php echo $projeto->dataFim ? explode(' ', $projeto->dataFim)[0] : '-'; ?></td>
                        <td><?php echo $projeto->companhia; ?></td>
                        
                        <td>
                            <div class="d-flex">
                                <a href="?controller=ProjetoController&method=editar&id=<?php echo $projeto->idProjeto; ?>" class="btn btn-primary btn-sm d-block me-1">Editar</a>

                                <a href="?controller=ProjetoController&method=excluir&id=<?php echo $projeto->idProjeto; ?>" class="btn btn-danger btn-sm d-block">Excluir</a>
                            </div>
                        </td>
                    </tr>
                <?php
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
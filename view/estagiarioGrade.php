<h1 class="ps-4 mt-2">Estagiarios</h1>
<?php 
$estgr = null;
?>
<div class="table-responsive">

    <table class="table table-bordered table-striped" style="top:40px;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Usuário</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Valor da Bolsa</th>
                <th>Auxilio</th>
                <th><a href="?controller=EstagiarioController&method=criar" class="btn btn-success btn-sm">Novo</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($estagiarios) {
                foreach ($estagiarios as $estagiario) {
            ?>
                    <tr>
                        <td><?php echo $estagiario->nome; ?></td>
                        <td><?php echo $estagiario->usuario; ?></td>
                        <td><?php echo $estagiario->telefone; ?></td>
                        <td><?php echo $estagiario->email; ?></td>
                        <td><?php echo $estagiario->valorBolsa ?></td>
                        <td><?php echo $estagiario->auxilio ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="?controller=EstagiarioController&method=editar&id=<?php echo $estagiario->idEstagiario; ?>" class="btn btn-primary btn-sm d-block me-1">Editar</a>
                                
                                <a href="?controller=EstagiarioController&method=excluir&id=<?php echo $estagiario->idEstagiario; ?>" class="btn btn-danger btn-sm d-block">Excluir</a>
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
<h1 class="ps-4 mt-2">Pagamentos</h1>
<div class="table-responsive">

    <table class="table table-bordered table-striped" style="top:40px;">
        <thead>
            <tr>
                <th>Estagiário</th>
                <th>Valor Pago</th>
                <th>Data</th>
                <th><a href="?controller=PagamentoController&method=criar" class="btn btn-success btn-sm">Novo</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($pagamentos) {
                foreach ($pagamentos as $pagamento) {
            ?>
                    <tr>
                        <td><?php echo $pagamento->nome; ?></td>
                        <td><?php echo $pagamento->valorPago; ?></td>
                        <td><?php echo $pagamento->data; ?></td>

                        <td>
                            <div class="d-flex">
                                <a href="?controller=PagamentoController&method=editar&id=<?php echo $pagamento->idPagamento; ?>" class="btn btn-primary btn-sm d-block me-1">Editar</a>

                                <a href="?controller=PagamentoController&method=excluir&id=<?php echo $pagamento->idPagamento; ?>" class="btn btn-danger btn-sm d-block">Excluir</a>
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
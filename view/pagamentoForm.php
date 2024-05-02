<div class="container">
    <form action="?controller=PagamentoController&<?php echo isset($pagamento->idPagamento) ? "method=atualizar&id={$pagamento->idPagamento}&idAnexo={$anexo->idAnexo}" : "method=salvar"; ?>" method="post" enctype="multipart/form-data">
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title"><?php echo isset($pagamento->idPagamento) ? "Editar Pagamento" : "Cadastrar Pagamento"; ?></span>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="mb-3 col-9">
                        <label for="idEstagiario" class="col-form-label">Estagiário:</label>
                        <select id="idEstagiario" name="idEstagiario" class="form-select" aria-label="Default select example">
                            <?php

                            foreach ($estagiarios as $estagiario) {

                            ?>
                                <option value="<?php echo $estagiario->idEstagiario; ?>"><?php echo $estagiario->nome ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 col">
                        <label for="message-text" class="col-form-label">Valor:</label>
                        <div class="input-group">
                            <input required value="<?php echo isset($pagamento->idPagamento) ? $pagamento->valorPago : null; ?>" name="valorPago" id="valorPago" type="text" class="form-control">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Descrição:</label>
                    <input value="<?php echo isset($pagamento->idPagamento) ? $pagamento->descricao : null; ?>" type="text" class="form-control" name="descricao" id="descricao">
                </div>

                <div class="mb-3 <?php echo isset($anexo->idAnexo) ? 'row' : null; ?>">
                    <div class="<?php echo isset($anexo->idAnexo) ? "col-9" : "" ?>">
                        <label for="recipient-name" class="col-form-label">Arquivo:</label>
                        <input value="<?php echo isset($anexo->idAnexo) ? $anexo->arquivo : null; ?>" type="file" class="form-control" name="arquivo" id="arquivo">
                    </div>


                    
                    <div class="col <?php echo isset($anexo->idAnexo) ? "d-flex" : "d-none" ?>">
                        <a href="?controller=PagamentoController&method=baixar&link=<?php echo urlencode($anexo->arquivo); ?>" class="d-block mt-auto ms-2">Baixar</a>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Descrição do Arquivo:</label>
                    <input value="<?php echo isset($anexo->idAnexo) ? $anexo->descricao : null; ?>" type="text" class="form-control" name="descricaoArquivo" id="descricaoArquivo">
                </div>
            </div>

            <div class="card-footer d-flex">
                <a href="?controller=PagamentoController&method=listar" class="btn btn-secondary ms-auto">Cancelar</a>
                <button class="btn btn-success ms-3" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</div>
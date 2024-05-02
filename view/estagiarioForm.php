<div class="container">
    <form action="?controller=EstagiarioController&<?php echo isset($estagiario->idEstagiario) ? "method=atualizar&id={$estagiario->idEstagiario}" : "method=salvar"; ?>" method="post">
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title"><?php echo isset($estagiario->idEstagiario) ? "Editar Estagiário" : "Cadastrar Estagiário"; ?></span>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nome:</label>
                    <input value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->nome : null; ?>" type="text" class="form-control" name="nome" id="nome">
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="message-text" class="col-form-label">Valor da Bolsa:</label>
                        <!-- <input type="number" class="form-control" ></input> -->
                        <div class="input-group">
                            <input value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->valorBolsa : null; ?>" name="valorBolsa" id="valorBolsa" type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                    </div>
                    <div class="mb-3 col">
                        <label for="message-text" class="col-form-label">Auxilio:</label>
                        <div class="input-group">
                            <input value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->auxilio : null; ?>" name="auxilio" id="auxilio" type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Email:</label>
                    <!-- <input type="email" class="form-control" ></input> -->
                    <div class="input-group">
                        <input value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->email : null; ?>" name="email" id="email" type="text" class="form-control" placeholder="" aria-label="email" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Usuário:</label>
                    <input value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->usuario : null; ?>" name="usuario" id="usuario" type="text" class="form-control" ></input>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Senha:</label>
                    <input value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->senha : null; ?>" name="senha" id="senha" type="text" class="form-control" ></input>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Telefone:</label>
                    <input value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->telefone : null; ?>" name="telefone" id="telefone" type="tel" class="form-control" ></input>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Endereço:</label>
                    <input type="text" value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->endereco : null; ?>" name="endereco" id="endereco" maxlength="250" class="form-control" ></input>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Dados Bancário:</label>
                    <input type="text" value="<?php echo isset($estagiario->idEstagiario) ? $estagiario->dadosBancario : null; ?>" name="dadosBancario" id="dadosBancario" maxlength="250" class="form-control" ></input>
                </div>
            </div>

            <div class="card-footer d-flex">
                <a href="?controller=EstagiarioController&method=listar" class="btn btn-secondary ms-auto" >Cancelar</a>
                <button class="btn btn-success ms-3" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</div>
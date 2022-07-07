<!-- Janela Nova Solicitaçao -->
<div class="modal fade" id="solicitarCertificado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solicitar Certificado Digital</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form class="needs-validation" method="post" action="modals/solicitar_sucesso.php" enctype="multipart/form-data" novalidate>
        <!--ESCOLHAS PARA O TIPO E VALOR DO CERTIFICADO SELECIONADO-->
        <section class="d-flex py-2">          
            <div class="col-sm-12 mx-auto text-center">
            <label for="type-cpf" class="form-label">Tipo do Certificado</label>
            <select name="tipo-certificado" class="form-select" id="type-cpf" required>
                <option value="">Escolha o certificado</option>
                <option>E-CPF A1 Midia Digital 1 ano</option>
                <option>E-CPF A3 Cartao 1 ano</option>
                <option>E-CPF A3 Cartao 2 anos</option>
                <option>E-CPF A3 Cartao 3 anos</option>
              	<option>E-CPF A3 Token 1 ano</option>
                <option>E-CPF A3 Token 2 anos</option>
                <option>E-CPF A3 Token 3 anos</option>
                <option>E-CPF A3 Cartao + Leitora 1 ano</option>
                <option>E-CPF A3 Cartao + Leitora 2 anos</option>
                <option>E-CPF A3 Cartao + Leitora 3 anos</option>
                <option>E-CPF A3 sem midia 1 ano</option>
                <option>E-CPF A3 sem midia 2 anos</option>
                <option>E-CPF A3 sem midia 3 anos</option>
                <option>E-CNPJ A1 Midia Digital 1 ano</option>
                <option>E-CNPJ A3 Cartao 1 ano</option>
                <option>E-CNPJ A3 Cartao 2 anos</option>
                <option>E-CNPJ A3 Cartao 3 anos</option>
              	<option>E-CNPJ A3 Token 1 ano</option>
                <option>E-CNPJ A3 Token 2 anos</option>
                <option>E-CNPJ A3 Token 3 anos</option>
                <option>E-CNPJ A3 Cartao + Leitora 1 ano</option>
                <option>E-CNPJ A3 Cartao + Leitora 2 anos</option>
                <option>E-CNPJ A3 Cartao + Leitora 3 anos</option>
                <option>E-CNPJ A3 sem midia 1 ano</option>
                <option>E-CNPJ A3 sem midia 2 anos</option>
                <option>E-CNPJ A3 sem midia 3 anos</option>
              	<option>(Outro tipo) 1 ano</option>
            </select><div class="invalid-feedback">Selecione um tipo de certificado.</div>
            </div>
        </section>
        
        <section class="d-flex py-2">
            <div class="col-sm-12 mx-auto"><!--NOME DO CLIENTE-->
            <label for="nome-cliente" class="form-label">Nome Completo</label>
            <input name="nome" type="text" class="form-control" id="nome-cliente" required>
            <div class="invalid-feedback">Insira o nome do cliente.</div>
            </div>
        </section>

        <section class="d-flex py-2">
            <div class="col-sm-5 mx-auto"><!--CPF DO CLIENTE-->
            <label for="cpf-cliente" class="form-label">CPF</label>
            <input name="cpf" type="text" class="form-control" id="cpf-cliente" required>
            <div class="invalid-feedback">Insira o CPF do cliente.</div>
            </div>
    
            <div class="col-sm-5 mx-auto"><!--DATA NASCIMENTO DO CLIENTE-->
            <label for="data-cliente" class="form-label">Data Nascimento</label>
            <input name="data-nascimento" type="date" class="form-control" id="data-cliente" required>
            <div class="invalid-feedback">Insira a data de nascimento do cliente.</div>
            </div>
        </section>
    
        <section class="d-flex py-2">
            <div class="col-sm-7 mx-auto"><!--EMAIL DO CLIENTE-->
            <label for="email-cliente" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email-cliente" required>
            <div class="invalid-feedback">Insira o email do cliente.</div>
            </div>
    
            <div class="col-sm-4 mx-auto"><!--TELEFONE DO CLIENTE-->
            <label for="endereco-cliente" class="form-label">Telefone</label>
            <input name="telefone" type="text" class="form-control" id="telefone-cliente" required>
            <div class="invalid-feedback">Insira o telefone do cliente.</div>
            </div>
        </section>
    
        <section class="d-flex py-2">
            <div class="col-sm-5 mx-auto"><!--CEP DO CLIENTE-->
            <label for="cep-cliente" class="form-label">CEP<span class="text-muted"></span></label>
            <input name="cep" type="text" id="cep" class="form-control" value="" size="10" maxlength="9"
                    onblur="pesquisacep(this.value);" required/>   
            <div class="invalid-feedback">Insira um CEP válido.</div>
            </div>
    
            <div class="col-sm-5 mx-auto"><!--BAIRRO DO CLIENTE-->
            <label for="bairro-cliente" class="form-label">Bairro<span class="text-muted"></span></label>
            <input name="bairro" type="text" id="bairro" class="form-control" size="40" required/>
            <div class="invalid-feedback">Insira o Bairro.</div>
            </div>
        </section>
    
        <section class="d-flex py-2">
            <div class="col-sm-9 mx-auto"><!--RUA DO CLIENTE-->
            <label for="rua-cliente" class="form-label">Rua (Logradouro)</label>
            <input name="rua" type="text" id="rua" class="form-control" size="80" required/>    
            <div class="invalid-feedback">Insira a rua do cliente.</div>
            </div>
    
            <div class="col-sm-2 mx-auto" id="num"><!--NUM DO CLIENTE-->
            <label for="num-cliente" class="form-label">N°<span class="text-muted"></span></label>
            <input name="num" type="number" class="form-control" id="num-cliente" min='0' required>
            <div class="invalid-feedback">Insira o número.</div>
            </div>        
        </section>
                
        <section class="d-flex py-2">        
            <div class="col-sm-12 mx-auto"><!--OBSERVACOES CLIENTE-->
            <label for="obs-cliente" class="form-label">OBSERVAÇÕES</label>
            <input name="observacoes" type="textarea" class="form-control" id="obs-cliente">
            </div>
        </section>
        
        <section class="d-flex py-2">
            <div class="col-sm-12 mx-auto text-center"><!--DOC. PESSOAL DO CLIENTE-->
            <label for="doc-cliente" class="form-label">Anexar documento pessoal (CNH, RG ou DNI).</label>
            <label for="doc-cliente" class="form-label">E documentos da empresa ou pessoa juridica (E-CNPJ).</label>
            <input type="file" name="documentos[]" multiple="multiple" class="form-control" id="doc-cliente" name="sendDocs" required>
            <div class="invalid-feedback">É necessário anexar os documentos do cliente.</div>
            </div>                      
        </section><hr class="my-4">
        <input class="w-100 btn btn-lg btn-primary" type="submit" name="btnSolicitar" value="Solicitar Certificado">
        </form>
    </div>
    </div>
</div>
</div>
<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E2S</title>    
    <link href="css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap core CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }@media (min-width: 768px) {.bd-placeholder-img-lg{font-size:3.5rem;}}
      main {max-width:800px;padding:25px;margin: auto;}
      #formulario {margin: auto;}p a{text-decoration: none;}
    </style>
    <!-- Javascript para CEP -->
<script>
    function limpa_formulário_cep() { //Limpa valores do formulário de cep.           
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
    }
    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {//Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
        }
        else {//CEP não Encontrado.            
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {
        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                //Cria um elemento javascript.
                var script = document.createElement('script');
                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);
            }
            else {//cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        }
        else { //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
</script>
</head>
<body class="bg-light">
<main>
<header class="py-5 text-center"><!--TOPO DA PÁGINA-->
  <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="80" height="50">
  <h2>Solicitação de Certificado Digital</h2>
  <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
</header>
<h2>Seja bem vindo, CONTADOR</h2>
</div>
<?php
  if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
  }
  ?>
<form class="needs-validation" method="post" action="" enctype="multipart/form-data" novalidate>
    <!--ESCOLHAS PARA O TIPO E VALOR DO CERTIFICADO SELECIONADO-->
    <div class="col-md-9 mx-auto text-center">
      <label for="type-cpf" class="form-label">Tipo do Certificado</label>
      <select name="tipo-certificado" class="form-select" id="type-cpf" required>
        <option>Escolha o certificado</option>
        <option>R$ 135,00 E-CPF A1 Mídia Digital</option>
        <option>R$ 190,00 E-CPF A3 Cartão 1 ano</option>
        <option>R$ 230,00 E-CPF A3 Cartão 2 anos</option>
        <option>R$ 265,00 E-CPF A3 Cartão 3 anos</option>
        <option>R$ 300,00 E-CPF A3 Cartão + Leitora 1 ano</option>
        <option>R$ 330,00 E-CPF A3 Cartão + Leitora 2 anos</option>
        <option>R$ 365,00 E-CPF A3 Cartão + Leitora 3 anos</option>
        <option>R$ 135,00 E-CPF A3 sem mídia 1 ano</option>
        <option>R$ 175,00 E-CPF A3 sem mídia 2 anos</option>
        <option>R$ 210,00 E-CPF A3 sem mídia 3 anos</option>
        <option>R$ 210,00 E-CNPJ A1 Mídia Digital</option>
        <option>R$ 190,00 E-CNPJ A3 Cartão 1 ano</option>
        <option>R$ 230,00 E-CNPJ A3 Cartão 2 anos</option>
        <option>R$ 265,00 E-CNPJ A3 Cartão 3 anos</option>
        <option>R$ 300,00 E-CNPJ A3 Cartão + Leitora 1 ano</option>
        <option>R$ 330,00 E-CNPJ A3 Cartão + Leitora 2 anos</option>
        <option>R$ 365,00 E-CNPJ A3 Cartão + Leitora 3 anos</option>
        <option>R$ 135,00 E-CNPJ A3 sem mídia 1 ano</option>
        <option>R$ 175,00 E-CNPJ A3 sem mídia 2 anos</option>
        <option>R$ 210,00 E-CNPJ A3 sem mídia 3 anos</option>
      </select><div class="invalid-feedback">Selecione um tipo de certificado.</div>
      </div>

      <div class="col-md-11 mx-auto"><!--NOME DO CLIENTE-->
        <label for="nome-cliente" class="form-label">Nome Completo</label>
        <input name="nome" type="text" class="form-control" id="nome-cliente" required>
        <div class="invalid-feedback">Insira o nome do cliente.</div>
      </div>

      <div class="col-sm-5 mx-auto"><!--CPF DO CLIENTE-->
        <label for="cpf-cliente" class="form-label">CPF</label>
        <input name="cpf" type="text" class="form-control" id="cpf-cliente" required>
        <div class="invalid-feedback">Insira o CPF do cliente.</div>
      </div>

      <div class="col-sm-5 ms-0 mx-auto"><!--DATA NASCIMENTO DO CLIENTE-->
        <label for="data-cliente" class="form-label">Data Nascimento</label>
        <input name="data-nascimento" type="date" class="form-control" id="data-cliente" required>
        <div class="invalid-feedback">Insira a data de nascimento do cliente.</div>
      </div>

      <div class="col-sm-6 mx-auto"><!--EMAIL DO CLIENTE-->
        <label for="email-cliente" class="form-label">Email</label>
        <input name="email" type="email" class="form-control" id="email-cliente" required>
        <div class="invalid-feedback">Insira o email do cliente.</div>
      </div>

      <div class="col-sm-4 ms-0 mx-auto"><!--TELEFONE DO CLIENTE-->
        <label for="endereco-cliente" class="form-label">Telefone</label>
        <input name="telefone" type="text" class="form-control" id="telefone-cliente" required>
        <div class="invalid-feedback">Insira o telefone do cliente.</div>
      </div>
  
      <div class="col-4 mx-auto"><!--CEP DO CLIENTE-->
        <label for="cep-cliente" class="form-label">CEP<span class="text-muted"></span></label>
        <input name="cep" type="text" id="cep" class="form-control" value="" size="10" maxlength="9"
               onblur="pesquisacep(this.value);" required/>   
        <div class="invalid-feedback">Insira um CEP válido.</div>
      </div>

      <div class="col-4 ms-0 mx-auto"><!--BAIRRO DO CLIENTE-->
        <label for="bairro-cliente" class="form-label">Bairro<span class="text-muted"></span></label>
        <input name="bairro" type="text" id="bairro" class="form-control" size="40" required/>
        <div class="invalid-feedback">Insira o Bairro.</div>
      </div>

      <div class="col-2 ms-0 mx-auto"><!--NUM DO CLIENTE-->
        <label for="num-cliente" class="form-label">N°<span class="text-muted"></span></label>
        <input name="num" type="number" class="form-control" id="num-cliente" required>
        <div class="invalid-feedback">Insira o número do endereço.</div>
      </div>

      <div class="col-md-11 mx-auto"><!--RUA DO CLIENTE-->
        <label for="rua-cliente" class="form-label">Rua (Logradouro)</label>
        <input name="rua" type="text" id="rua" class="form-control" size="60" required/>    
        <div class="invalid-feedback">Insira a rua do cliente.</div>
      </div>
           
      <div class="col-md-11 mx-auto"><!--OBSERVACOES CLIENTE-->
        <label for="obs-cliente" class="form-label">OBSERVACOES</label>
        <input name="observacoes" type="textarea" class="form-control" id="obs-cliente">
      </div>

      <div class="col-sm-10 mx-auto text-center"><!--DOC. PESSOAL DO CLIENTE-->
        <label for="doc-cliente" class="form-label">Anexar documento pessoal (CNH, RG ou DNI) e documentos da empresa ou pessoa jurídica (no caso de E-cnpj) </label>
        <input type="file" name="documentos[]" multiple="multiple" class="form-control" id="doc-cliente" name="sendDocs" required>
        <div class="invalid-feedback">É necessário anexar o documento pessoal do cliente.</div>
      </div><hr class="my-4">
      <input class="w-100 btn btn-lg btn-primary" type="submit" name="btnSolicitar" value="Solicitar Certificado">
    </form>
</main>  
<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; 2022 - E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por<a href="https://www.linkedin.com/in/rafaelcarvalho-ti"> Rafael Carvalho</a></p>
</footer>
</div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/form-validation.js"></script>
<?php 
        include_once('conexao.php');
        
        $tipo_certificado = $_POST["tipo-certificado"];
/*
        if (isset($tipo_certificado)) {
          $confirmaId = true;
        }*/

        $nome = strtoupper($_POST["nome"]);
        $cpf = $_POST["cpf"];
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $data_nascimento = $_POST["data-nascimento"];
        /*$doc_pessoal = $_POST[""];*/
        $email = strtolower($_POST["email"]);
        $telefone = $_POST["telefone"];
        $telefone = preg_replace("/[^0-9]()/", "", $telefone);
        $cep = $_POST["cep"];
        $cep = preg_replace("/[^0-9]()/", "", $cep);
        $bairro = $_POST["bairro"];
        $bairro = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$bairro);
        $bairro = strtoupper($bairro);
        $num = $_POST["num"];
        $rua = $_POST["rua"];
        $rua = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$rua);
        $rua = strtoupper($rua);        
        $endereco = "{$rua}, {$num} - {$bairro}";        
        $observacoes = strtoupper($_POST["observacoes"]);
        $result_solicitar = "INSERT INTO solicitacoes(tipo_certificado, nome, cpf, data_nascimento, email, telefone, cep, endereco, observacoes, data_solicitacao, contador, documentos) VALUES ('$tipo_certificado', '$nome', $cpf, '$data_nascimento', '$email', '$telefone', '$cep', '$endereco', '$observacoes', NOW(), 'GEONE', 'documentos')";
	      $resultado_solicitar= mysqli_query($connect, $result_solicitar);
        $_SESSION['msg'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        Certificado Digital solicitado com sucesso! Iremos realizar o cadastro do cliente e o atendimento. Aguarde nosso contato.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";     
        ?>
</body>
</html>
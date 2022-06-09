<?php
    session_start();
    include_once('conexao.php');
    if(isset($_SESSION['privilegio']) != 'Contador'){
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso somente para Contadores! <br> Realize o login para entrar no sistema.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header("Location: index.php");
    }
    if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
      unset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);        
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso restrito!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header('Location: index.php');        
    }else {
      if(isset($_SESSION['privilegio']) == true and $_SESSION['privilegio'] != 'Contador'){
        $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso somente para Contadores!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
        header("Location: index.php");
      }else {
        $logado = $_SESSION['usuario'];
      }      
    }    
?>
<?php
  include_once("conexao.php");
  if(!empty($_GET['search'])) {
    $mes = $_GET['search'];
    $ano = date("Y");
    $solicitar_dados = "SELECT * FROM solicitacoes WHERE contador = '$logado' AND MONTH(data_solicitacao) = '$mes' AND YEAR(data_solicitacao) = '$ano' ORDER BY id DESC";
  }
  else {
    $solicitar_dados = "SELECT * FROM solicitacoes WHERE contador = '$logado' ORDER BY id DESC";
  }
  $solicitacoes = mysqli_query($connect, $solicitar_dados);
  if($solicitacoes === FALSE) { 
    die(mysqli_error($connect));
  }
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E2S</title>    
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" type="imagex/png" href="img/icone.ico">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://e2scertificadoradigital.com.br/" style="color: white;" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link"><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#solicitarCertificado">Nova Solicitação</button></a>         
      </li>    
      <li class="nav-item">
        <a class="nav-link"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sairSistema">Sair</button></a>  
      </li>      
    </ul>   
  </div>
</nav>
<header class="py-4 text-center">
  <div class="usuario bg-primary">
    <h4 class="text-center mx-auto">Olá, <strong><?php echo $_SESSION['usuario']; ?></strong>. Seja bem vindo(a).</h4>
  </div>    
  <h2>Solicitar Certificado Digital</h2>
  <p class="lead">Faça a solicitação do certificado digital para seus clientes e acompanhe todas as solicitações feitas por você.</p>        
</header>
<main class="container">
<?php
  if (isset($_SESSION['solicitacaoSucesso'])) {
      echo $_SESSION['solicitacaoSucesso'];
      unset($_SESSION['solicitacaoSucesso']);
  }
?>
  <div class="componentes-contadores">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orientacoes">Orientações Importantes</button>      
    <section class="periodo-consulta">       
        <div>          
          <select name="mes-consulta" class="form-select" id="mes">
            <option value="">Período</option>
            <option value="01">Janeiro</option>
            <option value="02">Feveireiro</option>
            <option value="03">Março</option>
            <option value="04">Abril</option>
            <option value="05">Maio</option>
            <option value="06">Junho</option>
            <option value="07">Julho</option>
            <option value="08">Agosto</option>
            <option value="09">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>            
          </select>          
          <button id="bt-consulta" class="btn btn-primary" onclick="searchDataContador()"><i class="bi bi-search"></i></button>
        </div>               
    </section>
  </div>
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Cliente</th>
        <th scope="col">Certificado</th>
        <th scope="col">Data da solicitação</th>
      </tr>
    </thead>
    <tbody><?php while($rows_solicitacoes = mysqli_fetch_assoc($solicitacoes)){ ?>
      <tr>
        <td><?php echo $rows_solicitacoes['id']; ?></td>
        <td><?php echo $rows_solicitacoes['nome']; ?></td>
        <td><?php echo $rows_solicitacoes['tipo_certificado']; ?></td>        
        <td><?php echo $rows_solicitacoes['data_solicitacao']; ?></td>                        
      </tr><?php } ?>
    </tbody>
  </table>
</main>
<!-- Janela Orientacoes -->
<div class="modal fade" id="orientacoes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Orientações para solicitar o Certificado Digital</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="documentos">
          <h6>Documentos</h6>
          <ul>
            <li>Preencha todos os campos obrigatórios.</li>
            <li>Confira se os dados estão corretos.</li>
            <li>Envie todos os documentos requisitados.</li>
            <li>Documentos apenas ORIGINAIS, em bom estado e foto de boa qualidade.</li>
            <li>Não pode haver dedos ou qualquer outro objeto cobrindo as informações do documento.</li>
            <li>Só faça a solicitação do certificado quando houver todos os dados e documentos em mãos.</li>
            <li>Insira sempre os dados do CLIENTE, caso insira qualquer informação do contador o certificado poderá ser revogado.</li>
          </ul>
        </div>
        <div class="certificados">
          <h6>Certificados</h6>
          <ul>
            <li><b>Certificado A1</b> - Mídia Digital, instala em várias máquinas.</li>
            <li><b>Certificado A3</b> - Mídia Física (Token ou Cartão).</li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>
<!-- Janela Nova Solicitação -->
<div class="modal fade" id="solicitarCertificado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solicitar Certificado Digital</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" method="post" action="solicitar_sucesso.php" enctype="multipart/form-data" novalidate>
          <!--ESCOLHAS PARA O TIPO E VALOR DO CERTIFICADO SELECIONADO-->
          <section>          
            <div class="col-sm-12 mx-auto text-center">
              <label for="type-cpf" class="form-label">Tipo do Certificado</label>
              <select name="tipo-certificado" class="form-select" id="type-cpf" required>
                <option value="">Escolha o certificado</option>
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
          </section>
          
          <section>
            <div class="col-sm-12 mx-auto"><!--NOME DO CLIENTE-->
              <label for="nome-cliente" class="form-label">Nome Completo</label>
              <input name="nome" type="text" class="form-control" id="nome-cliente" required>
              <div class="invalid-feedback">Insira o nome do cliente.</div>
            </div>
          </section>

          <section>
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
      
          <section>
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
    
          <section>
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
      
          <section>
            <div class="col-sm-9 mx-auto"><!--RUA DO CLIENTE-->
              <label for="rua-cliente" class="form-label">Rua (Logradouro)</label>
              <input name="rua" type="text" id="rua" class="form-control" size="80" required/>    
              <div class="invalid-feedback">Insira a rua do cliente.</div>
            </div>
    
            <div class="col-sm-2 mx-auto" id="num"><!--NUM DO CLIENTE-->
              <label for="num-cliente" class="form-label">N°<span class="text-muted"></span></label>
              <input name="num" type="number" class="form-control" id="num-cliente" min="0" required>
              <div class="invalid-feedback">Insira o número.</div>
            </div>        
          </section>
                 
          <section>        
            <div class="col-sm-12 mx-auto"><!--OBSERVACOES CLIENTE-->
              <label for="obs-cliente" class="form-label">OBSERVACOES</label>
              <input name="observacoes" type="textarea" class="form-control" id="obs-cliente">
            </div>
          </section>
          
          <section>
            <div class="col-sm-12 mx-auto text-center"><!--DOC. PESSOAL DO CLIENTE-->
              <label for="doc-cliente" class="form-label">Anexar documento pessoal (CNH, RG ou DNI).</label>
              <label for="doc-cliente" class="form-label">E documentos da empresa ou pessoa jurídica (E-CNPJ).</label>
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
<!-- Janela Confirma Sair do Sistema (logout) -->
<div class="modal fade" id="sairSistema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sair do Sistema</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja sair do sistema e ir para tela de login? <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="sair.php"><button type='button' class='btn btn-primary'>Sair</button></a> 
      </div>
    </div>
  </div>
</div>  
<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; <?php echo date("Y");?> - AR E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por<a href="https://www.linkedin.com/in/rafaelcarvalho-ti"> Rafael Carvalho</a></p>
</footer>
</div>
</body>
<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>
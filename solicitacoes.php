<?php
    session_start();/*
    include_once('conexao.php');
    if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['privilegio']) == true) and (isset($_SESSION['privilegio']) != 'Administrador')) {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        unset($_SESSION['privilegio']);
        header('Location: login.php');
    }
    $logado = $_SESSION['usuario'];*/
?>
<?php
  include_once("conexao.php");
      
  if(!empty($_GET['search'])) {
    $mes = $_GET['search'];
    $ano = date("Y");
    $solicitar_dados = "SELECT * FROM solicitacoes WHERE MONTH(data_solicitacao) = '$mes' AND YEAR(data_solicitacao) = '$ano'";
  }
  else {
    $solicitar_dados = "SELECT * FROM solicitacoes";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" type="imagex/png" href="img/icone.ico">
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
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style="color: white;" ><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>   
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link"><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#solicitarCertificado">Nova Solicitação</button></a>                   
      </li>    
      <li class="nav-item">          
        <div class="nav-link">          
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Solicitações
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="solicitacoes.php">Ativas</a></li>
              <li><a class="dropdown-item" href="solicitacoes_concluidas.php">Concluidas</a></li>
            </ul>
          </div>
        </div> 
      </li>
      <li class="nav-item">
        <a class="nav-link" href="usuarios.php"><button type="button" class="btn btn-info">Usuários</button></a>          
      </li>    
      <li class="nav-item">
        <a class="nav-link"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sairSistema">Sair</button></a>  
      </li>      
    </ul>   
  </div>
</nav>
<main class="container">
    <div class="py-5 text-center">
      <h2>Solicitações de Certificados Digitais Ativas</h2>
      <p class="lead">Lista com todas as solicitações feitas por contadores ou administradores de sistema.</p>
    </div>  
    <?php
      if(isset($_SESSION['excluirSolicitacao'])){
        echo $_SESSION['excluirSolicitacao'];
        unset($_SESSION['excluirSolicitacao']);
      }
      if(isset($_SESSION['concluirSolicitacao'])){
        echo $_SESSION['concluirSolicitacao'];
        unset($_SESSION['concluirSolicitacao']);
      }
    ?>
    <section class="periodo-consulta">     
        <div class="col-sm-2 mx-auto text-center">
          <label for="mes" class="form-label">Mês de consulta</label>
          <select name="mes-consulta" class="form-select" id="mes">
            <option value="01">Janeiro</option>
            <option value="02 ">Feveireiro</option>
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
        </div>
     <button onclick="searchData()">AA</button>
    </section>
    <script>
      var search = document.getElementById('mes');

      search.addEventListener("keydown", function(event) {
          if (event.key === "Enter") 
          {
              searchData();
          }
      });

      function searchData()
      {
          window.location = 'solicitacoes.php?search='+search.value;
      }
    </script>
 
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Cliente</th>
          <th scope="col">Certificado</th>
          <th scope="col">Informações</th>
          <th scope="col">Data da solicitação</th>
          <th scope="col">Contador</th>
          <th scope="col">Documentos</th>
          <th scope="col">Situação</th>
        </tr>
      </thead>
      <tbody>
      <?php while($rows_solicitacoes = mysqli_fetch_assoc($solicitacoes)){ ?>
        <tr>
          <td><?php echo $rows_solicitacoes['id']; ?></td>
          <td><?php echo $rows_solicitacoes['nome']; ?></td>
          <td><?php echo $rows_solicitacoes['tipo_certificado']; ?></td>
          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#visualizarSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Visualizar</button></td>
          <td><?php echo $rows_solicitacoes['data_solicitacao']; ?></td>                  
          <td><?php echo $rows_solicitacoes['contador']; ?></td>
          <td><a href="documentos/<?php echo $rows_solicitacoes['documentos']; ?>"><button type="button" class="btn btn-primary">Baixar</button></a></td>
          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#concluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>"><i class="bi bi-check2-circle"></i></button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>"><i class="bi bi-trash"></i></button></td>
        </tr>
<!-- Janela Visualizar Informações Cliente -->
<div class="modal fade" id="visualizarSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="visualizarSolicitacaoLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="visualizarSolicitacaoLabel">Informações do cliente</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4>Nome</h4>
          <h3><?php echo $rows_solicitacoes['nome']; ?></h3>
          <h4>CPF</h4>
          <h3><?php echo $rows_solicitacoes['cpf']; ?></h3>
          <h4>Data de Nascimento</h4>
          <h3><?php echo date("d/m/Y",strtotime($rows_solicitacoes['data_nascimento'])); ?></h3>
          <h4>E-mail</h4>
          <h3><?php echo $rows_solicitacoes['email']; ?></h3>
          <h4>Telefone</h4>
          <h3><?php echo $rows_solicitacoes['telefone']; ?></h3>
          <hr>
          <h4>CEP</h4>
          <h3><?php echo $rows_solicitacoes['cep']; ?></h3>
          <h4>Endereço</h4>
          <h3><?php echo $rows_solicitacoes['endereco']; ?></h3>  
          <hr>
          <h4>Observações</h4>
          <h3><?php echo $rows_solicitacoes['observacoes']; ?></h3>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>
<!------------------------------>
<!-- Janela Confirma Excluir Solicitação -->
<div class="modal fade" id="excluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Excluir Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja excluir a solicitação de <?php echo $rows_solicitacoes['nome']; ?>? <br>
        Esta ação será irreversível.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <?php echo "<a href='excluir_solicitacao.php?id=" . $rows_solicitacoes['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Excluir</button></a>";?>
      </div>
    </div>
  </div>
</div>
<!------------------------------>
<!-- Janela Confirma Concluir Solicitação -->
<div class="modal fade" id="concluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Concluir Solicitação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja Concluir a solicitação de <?php echo $rows_solicitacoes['nome']; ?>? <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <?php echo "<a href='concluir_solicitacao.php?id=" . $rows_solicitacoes['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Concluir</button></a>";?>
      </div>
    </div>
  </div>
</div>
<!------------------------------><?php } ?>
</tbody>
</table>
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
              <input name="num" type="number" class="form-control" id="num-cliente" required>
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
<!------------------------------>
</main>
<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; <?php echo date("Y");?> - AR E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por<a href="https://www.linkedin.com/in/rafaelcarvalho-ti"> Rafael Carvalho</a></p>
</footer>
</body>
<script src="js/form-validation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>
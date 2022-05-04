<?php
  session_start();
  include_once("conexao.php");
  $solicitar_dados = "SELECT * FROM SOLICITACOES_CONCLUIDAS";
  $solicitacoes = mysqli_query($connect, $solicitar_dados);
/*
  echo $id_solicitacao;
  echo $tipo;
  echo $nome;
  echo $data1;
  echo $cont;*/

/*

  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  if (isset($id)) {
    echo $id;
    $confirmaId = true;
  }else {
    $confirmaId = false;
  }
  if ($confirmaId==true) {
    $id_solicitacao = $rows_solicitacoes['id'];
    $tipo = $rows_solicitacoes['tipo_certificado'];
    $nome = $rows_solicitacoes['nome'];
    $data1 = $rows_solicitacoes['data_solicitacao'];
    $cont = $rows_solicitacoes['contador'];
    $solicitacao_concluida = "INSERT INTO solicitacoes_concluidas(id, tipo_certificado, nome, data_solicitacao, contador, data_conclusao) VALUES ('$id_solicitacao', '$tipo', '$nome', '$data1', '$cont', NOW())";
	$solicitacao = mysqli_query($connect, $solicitacao_concluida);
    header("Location: solicitacoes.php");    
    $confirmaId = false;
  }*/

?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E2S</title>    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style="color: white;" ><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">          
          <div class="nav-link">          
            <div class="dropdown">
              <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
          <a class="nav-link" href="usuarios.php"><button type="button" class="btn btn-success">Usuários</button></a>          
        </li>        
      </ul>
    </div>
  </div>
</nav>
<main class="container">
    <div class="py-5 text-center">
      <h2>Solicitações Concluídas</h2>
      <p class="lead">Lista com todas as solicitações feitas por contadores ou administradores de sistema.</p>
    </div>  
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Cliente</th>
          <th scope="col">Certificado</th>
          <th scope="col">Data da solicitação</th>
          <th scope="col">Contador</th>
          <th scope="col">Data da conclusão</th>
        </tr>
      </thead>
      <tbody>
      <?php while($rows_solicitacoes = mysqli_fetch_assoc($solicitacoes)){ ?>
        <tr>
          <td><?php echo $rows_solicitacoes['id']; ?></td>
          <td><?php echo $rows_solicitacoes['nome']; ?></td>
          <td><?php echo $rows_solicitacoes['tipo_certificado']; ?></td>        
          <td><?php echo $rows_solicitacoes['data_solicitacao']; ?></td>                           
          <td><?php echo $rows_solicitacoes['contador']; ?></td>
          <td><?php echo $rows_solicitacoes['data_conclusao'];?></td> 
        </tr><?php } ?>
</tbody>
</table>
</main>
<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; 2022 - E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por <a href="https://www.linkedin.com/in/rafaelcarvalho-ti">Rafael Carvalho</a></p>
</footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>
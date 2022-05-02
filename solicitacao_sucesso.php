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
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }@media (min-width: 768px) {.bd-placeholder-img-lg{font-size:3.5rem;}}
  .container{max-width:768px;padding:25px;}p a{text-decoration:none;}
</style>
</head>
<body class="bg-light">
<div class="container">
  <main>
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="80" height="50">
        <h2>Solicitação enviada com sucesso.</h2>
        <p class="lead">Sua solicitação de certificado digital foi enviada, iremos realizar o cadastro e a videoconferência. Aguarde o contato da nossa empresa.</p>
      </div>
  </main>
  <?php 
        include_once('conexao.php');
        $tipo_certificado = $_POST["tipo-certificado"];
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
        /*$doc_empresa = $_POST[""];*/

        echo "tipo  ",$tipo_certificado;
        echo "<br>nome ",$nome;
        echo "<br>cpf ",$cpf;
        echo "<br>data ",$data_nascimento;
        echo "<br>email ",$email;
        echo "<br>tel ",$telefone;
        echo "<br>cep ",$cep;
        echo "<br>endereco ",$endereco;
        echo "<br>obs ",$observacoes;

        $result_solicitar = "INSERT INTO solicitacoes(tipo_certificado, nome, cpf, data_nascimento, email, telefone, cep, endereco, observacoes, data_solicitacao, situacao_solicitacao,	contador) VALUES ('$tipo_certificado', '$nome', $cpf, '$data_nascimento', '$email', '$telefone', '$cep', '$endereco', '$observacoes', NOW(), 'PROCESSANDO',	'GEONE')";
	      $resultado_solicitar= mysqli_query($connect, $result_solicitar);

        $_SESSION['sucesso'] = 'SOLICITAÇÃO ENVIADA COM SUCESSO';



        header("Location: solicitar.php");
        echo "<br>obs ",$_SESSION['sucesso'];
        
        ?>
<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; 2022 - E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por<a href="https://www.linkedin.com/in/rafaelcarvalho-ti"> Rafael Carvalho</a></p>
</footer>
</div>
</body>
</html>

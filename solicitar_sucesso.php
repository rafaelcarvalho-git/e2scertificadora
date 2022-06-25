<?php 
    session_start();
    include_once('conexao.php');
    if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
        unset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);
        header('Location: index.php');
    }else {
        if(!isset($_POST["tipo-certificado"])){
            header("Location: index.php");
        }
        $tipo_certificado = $_POST["tipo-certificado"];
        $nome = strtoupper($_POST["nome"]);
        $cpf = $_POST["cpf"];
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $data_nascimento = $_POST["data-nascimento"];    
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
        $contador = $_SESSION['usuario'];
        //documentos
        $diretorio = "documentos/";
        $cliente_documentos = $nome;
        if(!is_dir($diretorio)){ 
            echo "Pasta $diretorio nao existe";
        }else{
            $documentos = isset($_FILES['documentos']) ? $_FILES['documentos'] : FALSE;
            for ($controle = 0; $controle < count($documentos['name']); $controle++){		
                $destino = "documentos/".$documentos['name'][$controle];
                if(move_uploaded_file($documentos['tmp_name'][$controle], $destino)){
                    $zip = new ZipArchive();
                    $fileName= $cliente_documentos.'.zip';
                    $fullPath = $diretorio . DIRECTORY_SEPARATOR . $fileName;
                    if($zip->open($fullPath, ZipArchive::CREATE)) {
                        $zip->addFile($destino);
                        $zip->close();
                        if(file_exists($destino)) {unlink($destino);}
                    }                                         
                }
            }
        }
        $insert_solicitacao = "INSERT INTO solicitacoes(tipo_certificado, nome, cpf, data_nascimento, email, telefone, cep, endereco, observacoes, data_solicitacao, contador, documentos) VALUES ('$tipo_certificado', '$nome', '$cpf', '$data_nascimento', '$email', '$telefone', '$cep', '$endereco', '$observacoes', NOW(), '$contador', '$fileName')";
        $insert_solicitacao_query= mysqli_query($connect, $insert_solicitacao);    
        $insert_solicitacao_contador = "INSERT INTO solicitacoes_contadores(nome, tipo_certificado, data_solicitacao, contador) VALUES ('$nome', '$tipo_certificado', NOW(), '$contador')";
        $insert_solicitacao_query_contador= mysqli_query($connect, $insert_solicitacao_contador);  
        if($_SESSION['privilegio'] == 'Administrador'){
            $_SESSION['solicitacaoSucesso'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Certificado Digital solicitado com sucesso! Iremos realizar o cadastro do cliente e o atendimento. Aguarde nosso contato.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";  
            header("Location: solicitacoes_ativas.php");
        }else {
            $_SESSION['solicitacaoSucesso'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Certificado Digital solicitado com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";  
            header("Location: sistema_contadores.php");
        }  
    }    
?>
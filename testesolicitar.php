<?php 
    include_once('conexao.php');
    $result_solicitar = "INSERT INTO solicitacoes(tipo_certificado, nome, cpf, data_nascimento, email, telefone, cep, endereco, observacoes, data_solicitacao, contador, documentos) 
    VALUES 
    ('R$ 135,00 E-CPF A1 Mídia Digital', 'RAFAEL CANDIDO LACERDA CARVALHO', '17141342362', '2000-05-18', 'rafaelcarvalho@gmail.com', '88988573004', '63024380', 'RUA ENGENHEIRO JOSE ONOFRE MARQUES, 11 - SAO JOSE', 'Atender por videoconferencia', '2022-03-09 15:42:36', 'GEONE', 'documentos')";
	$resultado_solicitar= mysqli_query($connect, $result_solicitar);       
?>
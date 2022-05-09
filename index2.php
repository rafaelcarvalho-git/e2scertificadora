<?php
$arquivo = $_FILES['imagem'];

if ($arquivo !== null) {
    preg_match("/\.(png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);

    if($ext == true) {
        $nome_arquivo = md5(uniqid(time())) . "." . $ext[1];

        $caminho_arquivo = "documentos/" . $nome_arquivo;

        move_uploaded_file($arquivo["tmp_name"], $caminho_arquivo);

        include_once("conexao.php");

       // $sql = "INSERT INTO solicitacoes (documentos) VALUES ('$nome_arquivo',1)"
       // $a = mysqli_query($connect,$sql);

        $sql = "INSERT INTO solicitacoes(tipo_certificado, nome, cpf, data_nascimento, email, telefone, cep, endereco, observacoes, data_solicitacao, contador, documentos) 
        VALUES 
        ('R$ 135,00 E-CPF A1 Mídia Digital', 'RAFAEL CANDIDO LACERDA CARVALHO', '17141342362', '2000-05-18', 'rafaelcarvalho@gmail.com', '88988573004', '63024380', 'RUA ENGENHEIRO JOSE ONOFRE MARQUES, 11 - SAO JOSE', 'Atender por videoconferencia', NOW(), 'GEONE', '$nome_arquivo')";
        $resultado_solicitar= mysqli_query($connect, $sql);   
    }
}


$zip = new ZipArchive();

$fileName= 'zipado.zip';

$path = __DIR__;
$fullPath = $path . DIRECTORY_SEPARATOR . $fileName;

if($zip->open($fullPath, ZipArchive::CREATE)) {
    $zip->addFile(
        $path . '/documentos/goku.png', 'goku.png'
    );

    $zip->close();

}

if (file_exists($fullPath)) {
    echo 'existe e criado';
    exit;
}
echo 'erro';


?>

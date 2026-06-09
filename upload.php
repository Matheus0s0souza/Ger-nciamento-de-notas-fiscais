<?php

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $codigo_nf = trim($_POST["codigo_nf"]);

    if (empty($codigo_nf)) {
        die("Código NF inválido.");
    }

    if (!isset($_FILES["imagem"]) || $_FILES["imagem"]["error"] != 0) {
        die("Erro ao enviar imagem.");
    }

    // Pasta correta (relativa)
    $pasta = "CanhotoKozzy/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    $arquivoTmp = $_FILES["imagem"]["tmp_name"];
    $nomeOriginal = $_FILES["imagem"]["name"];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    $permitidas = ["jpg", "jpeg", "png", "gif"];

    if (!in_array($extensao, $permitidas)) {
        die("Formato não permitido.");
    }

    $novoNome = time() . "_" . preg_replace("/[^a-zA-Z0-9]/", "", $codigo_nf) . "." . $extensao;

    $caminhoFinal = $pasta . $novoNome;

    if (!move_uploaded_file($arquivoTmp, $caminhoFinal)) {
        die("Erro ao salvar imagem.");
    }

    // TABELA CORRETA
    $stmt = $mysqli->prepare("INSERT INTO canhoto (codigo_nf, imagem) VALUES (?, ?)");
    $stmt->bind_param("ss", $codigo_nf, $novoNome);

    if ($stmt->execute()) {
        echo "Canhoto enviado com sucesso!";
    } else {
        echo "Erro ao salvar no banco: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>
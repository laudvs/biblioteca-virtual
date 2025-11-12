<?php
session_start();
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $descricao = trim($_POST['descricao']);
    $capa = trim($_POST['capa']);

    if (!empty($titulo) && !empty($autor) && !empty($descricao) && !empty($capa)) {
        $stmt = $conn->prepare("INSERT INTO livros (titulo, autor, descricao, capa) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $titulo, $autor, $descricao, $capa);

        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "Livro cadastrado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar o livro.";
        }

        $stmt->close();
    } else {
        $_SESSION['mensagem'] = "Preencha todos os campos!";
    }

    header("Location: ../front-end/sucesso_livro.php");
    exit();
}
?>

<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: ../front-end/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro_id = $_POST['livro_id'];
    $usuario_id = $_POST['usuario_id'];
    $comentario = $_POST['comentario'];
    $nota = $_POST['nota'];

    $stmt = $conn->prepare("INSERT INTO comentarios (livro_id, usuario_id, comentario, nota) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $livro_id, $usuario_id, $comentario, $nota);
    $stmt->execute();
    header("Location: ../front-end/livros.php?id=" . $livro_id);
    exit();
}
?>

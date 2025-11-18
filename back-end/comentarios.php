<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: ../front-end/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro_id = isset($_POST['livro_id']) ? (int) $_POST['livro_id'] : 0;
    $usuario = $_SESSION['usuario'];
    $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
    $nota = isset($_POST['nota']) ? (int) $_POST['nota'] : null;

    if ($livro_id <= 0 || $comentario === '' || $nota === null) {
        header("Location: ../front-end/index.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO comentarios (livro_id, usuario, comentario, nota) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Erro na preparação: ' . $conn->error);
    }
    $stmt->bind_param("issi", $livro_id, $usuario, $comentario, $nota);
    $stmt->execute();
    $stmt->close();

    header("Location: ../front-end/index.php#livro-" . $livro_id);
    exit();
}
?>

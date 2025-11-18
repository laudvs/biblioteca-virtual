<?php
session_start();

if(!isset($_SESSION['usuario'])){
  header("Location: ../front-end/login.php");
  exit();
}

include("conexao.php");

// Recebe os dados do formulário
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$descricao = $_POST['descricao'];
$capa = $_POST['capa'];

// Insere no banco
$sql = "INSERT INTO livros (titulo, autor, descricao, capa) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $titulo, $autor, $descricao, $capa);

if ($stmt->execute()) {
    $_SESSION['message'] = "✅ Livro adicionado com sucesso!";
} else {
    $_SESSION['message'] = "❌ Erro ao adicionar o livro.";
}

$stmt->close();
$conn->close();

header("Location: ../front-end/admin.php");
exit();
?>

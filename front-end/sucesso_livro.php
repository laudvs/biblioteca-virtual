<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header("Location: login.php");
  exit();
}

$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : "Ação concluída!";
unset($_SESSION['mensagem']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirmação - BookLovers</title>
<link rel="stylesheet" href="livros.css">
</head>
<body>

<header class="topo">
  <h1>📚 BookLovers</h1>
  <nav>
    <ul>
      <li><a href="index.php">Início</a></li>
      <li><a href="livros.php">Livros</a></li>
      <li><span>👤 <?= $_SESSION['usuario']; ?></span></li>
      <li><a href="../back-end/logout.php">Sair</a></li>
    </ul>
  </nav>
</header>

<main class="conteudo">
  <div class="caixa-mensagem">
    <h2><?= htmlspecialchars($mensagem) ?></h2>
    <a href="livros.php" class="botao-voltar">⬅ Voltar para Livros</a>
  </div>
</main>

<footer>
  <p>© 2025 BookLovers - Todos os direitos reservados.</p>
</footer>

</body>
</html>

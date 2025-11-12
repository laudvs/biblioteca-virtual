<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adicionar Livro - BookLovers</title>
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
  <h2>➕ Adicionar Novo Livro</h2>

  <form action="../back-end/processar_livro.php" method="POST" class="form-livro">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Digite o título do livro" required>

    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" placeholder="Digite o nome do autor" required>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" rows="4" placeholder="Digite uma breve descrição" required></textarea>

    <label for="capa">URL da Capa (imagem):</label>
    <input type="url" id="capa" name="capa" placeholder="Cole o link da imagem de capa" required>

    <button type="submit" class="botao-adicionar">Salvar Livro</button>
  </form>
</main>

<footer>
  <p>© 2025 BookLovers - Todos os direitos reservados.</p>
</footer>

</body>
</html>

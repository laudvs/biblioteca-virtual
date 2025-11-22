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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="adicionar_livro.css">
</head>

<body>
  <header class="topo">
    <div class="logo">
      <i class="fa-solid fa-book-open-reader"></i>
      <span>BookLovers</span>
    </div>
    <nav>
      <a href="index.php">
        <i class="fas fa-home"></i> Início
      </a>
      <a href="livros.php">
        <i class="fas fa-book"></i> Livros
      </a>
      <span style="color: white;">👤 <?= htmlspecialchars($_SESSION['usuario']); ?></span>
      <a href="../back-end/logout.php">
        <i class="fas fa-sign-out-alt"></i> Sair
      </a>
    </nav>
  </header>

  <main>
    <div class="form-container">
      <h2>
        <i class="fas fa-plus-circle"></i>
        Adicionar Novo Livro
      </h2>

      <form action="../back-end/processar_livro.php" method="POST">
        <div class="form-group">
          <label for="titulo"><i class="fas fa-heading"></i> Título:</label>
          <input type="text" id="titulo" name="titulo" placeholder="Digite o título do livro" required>
        </div>

        <div class="form-group">
          <label for="autor"><i class="fas fa-pen-fancy"></i> Autor:</label>
          <input type="text" id="autor" name="autor" placeholder="Digite o nome do autor" required>
        </div>

        <div class="form-group">
          <label for="descricao"><i class="fas fa-align-left"></i> Descrição:</label>
          <textarea id="descricao" name="descricao" placeholder="Digite uma breve descrição do livro" required></textarea>
        </div>

        <div class="form-group">
          <label for="capa"><i class="fas fa-image"></i> URL da Capa:</label>
          <input type="url" id="capa" name="capa" placeholder="Cole o link da imagem de capa" required>
        </div>

        <button type="submit">
          <i class="fas fa-save"></i> Salvar Livro
        </button>
      </form>
    </div>
  </main>

  <footer>
    <p>📖 BookLovers © 2025 | Contribua com a comunidade</p>
  </footer>
</body>
</html>

<?php
session_start();

// Apenas usuários logados podem acessar
if(!isset($_SESSION['usuario'])){
  header("Location: login.php");
  exit();
}

// Conexão com o banco
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booklovers";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

// Buscar livros existentes
$sql = "SELECT * FROM livros ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel do Administrador - BookLovers</title>
<link rel="stylesheet" href="admin.css">
</head>

<body>
<header class="topo">
  <h1>📚 Painel - BookLovers</h1>
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
  <h2>📖 Cadastro de Livros</h2>

  <!-- Formulário para cadastrar novo livro -->
  <form action="../back-end/salvar_livro.php" method="POST" class="form-livro">
    <label>Título:</label>
    <input type="text" name="titulo" required>

    <label>Autor:</label>
    <input type="text" name="autor" required>

    <label>Descrição:</label>
    <textarea name="descricao" rows="3" required></textarea>

    <label>Link da Capa (URL da imagem):</label>
    <input type="text" name="imagem" placeholder="https://..." required>

    <button type="submit">Adicionar Livro</button>
  </form>

  <h2>📚 Livros Cadastrados</h2>

  <div class="livros-lista">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($livro = $result->fetch_assoc()): ?>
        <div class="livro-item">
          <img src="<?= htmlspecialchars($livro['imagem']); ?>" alt="Capa do livro">
          <div>
            <h3><?= htmlspecialchars($livro['titulo']); ?></h3>
            <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']); ?></p>
            <p><?= htmlspecialchars($livro['descricao']); ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>Nenhum livro cadastrado.</p>
    <?php endif; ?>
  </div>
</main>

<footer>
  <p>© 2025 BookLovers - Todos os direitos reservados.</p>
</footer>
</body>
</html>

<?php $conn->close(); ?>

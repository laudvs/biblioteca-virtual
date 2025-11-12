<?php
session_start();
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

// Verifica se o ID foi enviado
if (!isset($_GET['id'])) {
  echo "Livro não encontrado!";
  exit();
}

$id = intval($_GET['id']);

// Busca os dados do livro
$sql = "SELECT * FROM livros WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
  echo "Livro não encontrado!";
  exit();
}

$livro = $result->fetch_assoc();

// Inserir novo comentário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = $_SESSION['usuario'];
  $comentario = $conn->real_escape_string($_POST['comentario']);
  $nota = intval($_POST['nota']);

  $sql_coment = "INSERT INTO comentarios (livro_id, usuario, comentario, nota, data) 
                 VALUES ($id, '$usuario', '$comentario', $nota, NOW())";
  $conn->query($sql_coment);
  header("Location: livro_detalhe.php?id=$id");
  exit();
}

// Buscar comentários
$sql_comentarios = "SELECT * FROM comentarios WHERE livro_id = $id ORDER BY data DESC";
$result_comentarios = $conn->query($sql_comentarios);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($livro['titulo']); ?> - BookLovers</title>
<link rel="stylesheet" href="livro_detalhe.css">
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
  <div class="livro-detalhe">
    <img src="<?= htmlspecialchars($livro['imagem']); ?>" alt="Capa do livro">
    <div class="info">
      <h2><?= htmlspecialchars($livro['titulo']); ?></h2>
      <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']); ?></p>
      <p><strong>Descrição:</strong> <?= htmlspecialchars($livro['descricao']); ?></p>
    </div>
  </div>

  <section class="comentarios">
    <h3>💬 Comentários e Avaliações</h3>

    <form method="POST">
      <label for="comentario">Deixe seu comentário:</label><br>
      <textarea name="comentario" id="comentario" rows="4" required></textarea><br>

      <label for="nota">Sua nota:</label>
      <select name="nota" id="nota" required>
        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
        <option value="4">⭐⭐⭐⭐ (4)</option>
        <option value="3">⭐⭐⭐ (3)</option>
        <option value="2">⭐⭐ (2)</option>
        <option value="1">⭐ (1)</option>
      </select>

      <button type="submit">Enviar avaliação</button>
    </form>

    <div class="lista-comentarios">
      <?php if ($result_comentarios->num_rows > 0): ?>
        <?php while($c = $result_comentarios->fetch_assoc()): ?>
          <div class="comentario">
            <p><strong><?= htmlspecialchars($c['usuario']); ?></strong> — <?= str_repeat("⭐", $c['nota']); ?></p>
            <p><?= htmlspecialchars($c['comentario']); ?></p>
            <small>📅 <?= date('d/m/Y H:i', strtotime($c['data'])); ?></small>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>Seja o primeiro a comentar este livro!</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<footer>
<p>© 2025 BookLovers - Todos os direitos reservados.</p>
</footer>
</body>
</html>

<?php $conn->close(); ?>

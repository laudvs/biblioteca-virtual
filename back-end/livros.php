<?php
// back-end/livros.php
session_start();

// Verifica se o usuário está logado
if(!isset($_SESSION['usuario'])){
  header("Location: ../front-end/login.php");
  exit();
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booklovers";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

// Cadastrar novo livro
if(isset($_POST['cadastrar'])){
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $descricao = $_POST['descricao'];
  $imagem = $_POST['imagem'];

  $sql = "INSERT INTO livros (titulo, autor, descricao, imagem) VALUES ('$titulo', '$autor', '$descricao', '$imagem')";
  if($conn->query($sql)){
    $mensagem = "✅ Livro cadastrado com sucesso!";
  } else {
    $mensagem = "❌ Erro ao cadastrar livro: " . $conn->error;
  }
}

// Excluir livro
if(isset($_GET['excluir'])){
  $id = $_GET['excluir'];
  $sql = "DELETE FROM livros WHERE id=$id";
  if($conn->query($sql)){
    $mensagem = "🗑️ Livro excluído com sucesso!";
  } else {
    $mensagem = "❌ Erro ao excluir livro: " . $conn->error;
  }
}

// Listar livros
$sql = "SELECT * FROM livros ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gerenciar Livros - Painel Admin</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>

<header>
  <h1>📖 Painel do Administrador</h1>
  <nav>
    <a href="../front-end/index.php">Início</a> |
    <a href="../front-end/livros.php">Ver Livros</a> |
    <a href="logout.php">Sair</a>
  </nav>
</header>

<main>
  <h2>Cadastro de Livros</h2>

  <?php if(isset($mensagem)) echo "<p><strong>$mensagem</strong></p>"; ?>

  <form method="POST" class="form-cadastro">
    <label>Título:</label>
    <input type="text" name="titulo" required>

    <label>Autor:</label>
    <input type="text" name="autor" required>

    <label>Descrição:</label>
    <textarea name="descricao" required></textarea>

    <label>URL da imagem (capa):</label>
    <input type="text" name="imagem" placeholder="https://...jpg">

    <button type="submit" name="cadastrar">Cadastrar Livro</button>
  </form>

  <hr>

  <h2>Lista de Livros</h2>

  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Título</th>
      <th>Autor</th>
      <th>Descrição</th>
      <th>Imagem</th>
      <th>Ações</th>
    </tr>

    <?php if($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id']; ?></td>
          <td><?= htmlspecialchars($row['titulo']); ?></td>
          <td><?= htmlspecialchars($row['autor']); ?></td>
          <td><?= htmlspecialchars($row['descricao']); ?></td>
          <td><img src="<?= htmlspecialchars($row['imagem']); ?>" width="80"></td>
          <td>
            <a href="?excluir=<?= $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="6">Nenhum livro cadastrado ainda.</td></tr>
    <?php endif; ?>
  </table>
</main>

<footer>
  <p>© 2025 BookLovers - Painel de Administração</p>
</footer>

</body>
</html>

<?php $conn->close(); ?>

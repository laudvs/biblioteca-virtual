<?php 
session_start();
include_once '../back-end/conexao.php';
$logado = isset($_SESSION['usuario']);

// Busca livros do banco
$livros = [];
$res = $conn->query("SELECT * FROM livros ORDER BY id DESC");
if ($res) {
  while ($row = $res->fetch_assoc()) {
    $livros[] = $row;
  }
  $res->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Booklovers</title>
<link rel="stylesheet" href="style.css" />
<script defer src="script.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
<header class="header">
<div class="logo">
  <i class="fa-solid fa-book-open-reader"></i>
  <h1>Booklovers</h1>
</div>

<nav class="navbar">
  <a href="index.php" class="active">Início</a>
  <a href="livros.php">Meus Livros</a>

  <?php if($logado): ?>
    <span class="bemvinda">Olá, <strong><?= $_SESSION['usuario']; ?></strong></span>
    <a href="../back-end/logout.php">Sair</a>
  <?php else: ?>
    <a href="login.php">Entrar</a>
  <?php endif; ?>
</nav>
</header>

<section class="banner">
<div class="banner-content">
  <h2>Bem-vindo(a) à sua Biblioteca Virtual 🌸</h2>
  <p>Organize seus livros lidos, adicione notas e descubra novas leituras com a comunidade Booklovers!</p>
  <a href="livros.php" class="btn">Ver Meus Livros</a>
</div>
</section>

<section class="destaques">
<h2><i class="fa-solid fa-star"></i> Destaques da Comunidade</h2>

<!-- FILTRO DE BUSCA -->
<div class="filtro-container">
  <input type="text" id="filtro-busca" placeholder="🔍 Buscar por título ou autor..." autocomplete="off">
  <button type="button" onclick="limparFiltro()">Limpar</button>
</div>
<div id="resultado-busca" class="resultado-busca"></div>

<div class="livros-grid" id="livros-container">

<?php if (count($livros) > 0): ?>
  <?php foreach ($livros as $livro): ?>
    <?php
    // busca comentários do livro
    $comentarios = [];
    $stmt = $conn->prepare("SELECT usuario, comentario, nota, data FROM comentarios WHERE livro_id = ? ORDER BY data DESC");
    if ($stmt) {
      $stmt->bind_param('i', $livro['id']);
      $stmt->execute();
      $resC = $stmt->get_result();
      while ($c = $resC->fetch_assoc()) { $comentarios[] = $c; }
      $stmt->close();
    }
    ?>

    <div class="livro-card" id="livro-<?= $livro['id'] ?>">
      <img src="<?= htmlspecialchars($livro['capa']); ?>" alt="Capa">
      <h3><?= htmlspecialchars($livro['titulo']); ?></h3>
      <p><?= htmlspecialchars($livro['autor']); ?></p>

      <!-- Média das notas -->
      <?php
      $media = null;
      if (count($comentarios) > 0) {
        $soma = 0; foreach ($comentarios as $c) { $soma += (int)$c['nota']; }
        $media = round($soma / count($comentarios), 1);
      }
      ?>
      <span class="nota">⭐ <?= $media !== null ? $media : '—' ?></span>

      <!-- Lista de comentários -->
      <div class="comentarios">
        <?php if (count($comentarios) > 0): ?>
          <?php foreach ($comentarios as $c): ?>
            <div class="comentario-item">
              <strong><?= htmlspecialchars($c['usuario']); ?></strong>
              <span class="nota-pequena">⭐ <?= (int)$c['nota'] ?></span>
              <p><?= nl2br(htmlspecialchars($c['comentario'])); ?></p>
              <small><?= htmlspecialchars($c['data']); ?></small>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="sem-comentarios">Seja o primeiro a comentar!</p>
        <?php endif; ?>
      </div>

      <!-- Formulário para adicionar comentário (apenas para usuários logados) -->
      <?php if ($logado): ?>
        <form action="../back-end/comentarios.php" method="POST" class="form-comentario">
          <input type="hidden" name="livro_id" value="<?= $livro['id'] ?>">
          <label>Comentário:</label>
          <textarea name="comentario" rows="2" required></textarea>
          <label>Nota:</label>
          <select name="nota" required>
            <option value="5">5</option>
            <option value="4">4</option>
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
          </select>
          <button type="submit">Enviar</button>
        </form>
      <?php else: ?>
        <p><a href="login.php">Entre</a> para comentar e avaliar.</p>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p>Nenhum livro cadastrado ainda.</p>
<?php endif; ?>

</div>
</section>

<!-- SCRIPT DE FILTRO -->
<script>
const filtroInput = document.getElementById('filtro-busca');
const livrosContainer = document.getElementById('livros-container');
const resultadoBusca = document.getElementById('resultado-busca');
const livrosCards = Array.from(livrosContainer.querySelectorAll('.livro-card'));

filtroInput.addEventListener('input', function() {
  const termo = this.value.toLowerCase().trim();
  
  if (termo === '') {
    livrosCards.forEach(card => card.style.display = 'block');
    resultadoBusca.textContent = '';
    return;
  }
  
  let encontrados = 0;
  
  livrosCards.forEach(card => {
    const titulo = card.querySelector('h3').textContent.toLowerCase();
    const autor = card.querySelector('p').textContent.toLowerCase();
    
    if (titulo.includes(termo) || autor.includes(termo)) {
      card.style.display = 'block';
      encontrados++;
    } else {
      card.style.display = 'none';
    }
  });
  
  if (encontrados === 0) {
    resultadoBusca.textContent = `❌ Nenhum livro encontrado para "${termo}"`;
    resultadoBusca.style.color = '#ff4c4c';
  } else {
    resultadoBusca.textContent = `✅ ${encontrados} livro(s) encontrado(s)`;
    resultadoBusca.style.color = '#7f00ff';
  }
});

function limparFiltro() {
  filtroInput.value = '';
  livrosCards.forEach(card => card.style.display = 'block');
  resultadoBusca.textContent = '';
  filtroInput.focus();
}
</script>

<section class="sobre">
<h2><i class="fa-solid fa-heart"></i> Sobre o Booklovers</h2>
<p>O Booklovers é um espaço feito para amantes da leitura! Aqui você pode registrar seus livros lidos, dar notas e acompanhar seu progresso literário.</p>
<p>Em breve: comunidade, recomendações e muito mais 💫</p>
</section>

<footer class="footer">
<p>📖 Booklovers © 2025 | Desenvolvido com 💜 por Laulis</p>
</footer>
</body>
</html>

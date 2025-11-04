<?php 
session_start();
$logado = isset($_SESSION['usuario']);
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
<div class="livros-grid">

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/71y3Wua1b5L._SL1500_.jpg">
<h3>Livrai-nos do Mal</h3>
<p>Rose Wilding</p>
<span class="nota">⭐ 4.9</span>
</div>

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/919+LCGBrML._SL1500_.jpg">
<h3>A mágica mortal</h3>
<p>Raphael Montes</p>
<span class="nota">⭐ 4.5</span>
</div>

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/812RDxFDd8L._SL1500_.jpg">
<h3>Noiva</h3>
<p>Ali Hazelwood</p>
<span class="nota">⭐ 3.9</span>
</div>

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/91SDZ2eUj+L._SL1500_.jpg">
<h3>Verity</h3>
<p>Colleen Hoover</p>
<span class="nota">⭐ 4.3</span>
</div>

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/81BTIjoeeYL._SL1500_.jpg">
<h3>Textos para tocar cicatrizes</h3>
<p>Igor Pires</p>
<span class="nota">⭐ 4.0</span>
</div>

</div>
</section>

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

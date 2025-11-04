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
<title>Livros - BookLovers</title>
<link rel="stylesheet" href="livros.css">
</head>

<body>
<header class="topo">
<h1>📚 BookLovers</h1>
<nav>
<ul>
<li><a href="index.php">Início</a></li>
<li><a href="livros.php" class="ativo">Livros</a></li>
<li><span>👤 <?= $_SESSION['usuario']; ?></span></li>
<li><a href="../back-end/logout.php">Sair</a></li>
</ul>
</nav>
</header>

<main class="conteudo">
<h2>Explore nossos livros</h2>

<div class="livros-container">

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/715JOcuqSSL._SL1021_.jpg">
<h3>A Metamorfose</h3>
<p><strong>Autor:</strong> Franz Kafka</p>
<p class="descricao">O caixeiro-viajante Gregor acorda metamorfoseado em um inseto...</p>
<button>Ver mais</button>
</div>

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/9157mzaUZ1L._SL1500_.jpg">
<h3>Pequena Coreografia do Adeus</h3>
<p><strong>Autor:</strong> Aline Bei</p>
<p class="descricao">Entre lembranças da infância e da adolescência...</p>
<button>Ver mais</button>
</div>

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/81sblL-t2iL._SL1417_.jpg">
<h3>Declínio de um Homem</h3>
<p><strong>Autor:</strong> Osamu Dazai</p>
<p class="descricao">A obra sintetiza passagens biográficas...</p>
<button>Ver mais</button>
</div>

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/61t0bwt1s3L._SL1000_.jpg">
<h3>1984</h3>
<p><strong>Autor:</strong> George Orwell</p>
<p class="descricao">Winston reescreve artigos para o Partido...</p>
<button>Ver mais</button>
</div>

<div class="livro-card">
<img src="https://m.media-amazon.com/images/I/618-b9Im6dL._SL1457_.jpg">
<h3>Vidas Secas</h3>
<p><strong>Autor:</strong> Graciliano Ramos</p>
<p class="descricao">A crueldade da seca no sertão nordestino...</p>
<button>Ver mais</button>
</div>

</div>
</main>

<footer>
<p>© 2025 BookLovers - Todos os direitos reservados.</p>
</footer>
</body>
</html>

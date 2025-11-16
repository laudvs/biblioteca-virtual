<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booklovers";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$usuarioId = $_SESSION['id_usuario'];
$sql = "SELECT * FROM livros WHERE usuario_id = $usuarioId ORDER BY id DESC";
$resultado = $conn->query($sql);
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
    <div class="cabecalho-livros">
        <h2>Meus livros</h2>
        <a href="adicionar_livro.php" class="botao-adicionar">➕ Adicionar Livro</a>
    </div>

    <div class="livros-container">

        <?php
        if ($resultado->num_rows > 0) {
            while ($livro = $resultado->fetch_assoc()) {
                echo '<div class="livro-card">';
                echo '<img src="' . htmlspecialchars($livro['capa']) . '" alt="Capa do livro">';
                echo '<h3>' . htmlspecialchars($livro['titulo']) . '</h3>';
                echo '<p><strong>Autor:</strong> ' . htmlspecialchars($livro['autor']) . '</p>';
                echo '<p class="descricao">' . htmlspecialchars($livro['descricao']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhum livro encontrado ainda. Adicione o seu primeiro livro! 📘</p>';
        }

        $conn->close();
        ?>

    </div>
</main>

<footer>
<p>© 2025 BookLovers - Todos os direitos reservados.</p>
</footer>
</body>
</html>

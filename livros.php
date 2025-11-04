<?php
include("../back-end/conexao.php");
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
                <li><a href="index.html">Início</a></li>
                <li><a href="livros.php" class="ativo">Livros</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="cadastro.html">Cadastro</a></li>
            </ul>
        </nav>
    </header>

    <main class="conteudo">
        <h2>Explore nossos livros</h2>
        <div class="livros-container">
            <?php
            $sql = "SELECT * FROM livros";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                while ($livro = $resultado->fetch_assoc()) {
                    echo '<div class="livro-card">';
                    echo '<img src="' . htmlspecialchars($livro['capa']) . '" alt="Capa do livro">';
                    echo '<h3>' . htmlspecialchars($livro['titulo']) . '</h3>';
                    echo '<p><strong>Autor:</strong> ' . htmlspecialchars($livro['autor']) . '</p>';
                    echo '<p class="descricao">' . htmlspecialchars($livro['descricao']) . '</p>';
                    echo '<button>Ver mais</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>Nenhum livro encontrado no momento.</p>';
            }

            $conn->close();
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 BookLovers - Todos os direitos reservados.</p>
    </footer>
</body>
</html>

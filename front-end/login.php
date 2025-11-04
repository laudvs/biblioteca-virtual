<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookLovers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <div class="container">
            <h2>Login</h2>

            <!-- Local onde a mensagem do PHP será exibida -->
            <?php if (isset($_SESSION['message'])): ?>
                <p class="msg"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
            <?php endif; ?>

            <form action="../back-end/login_process.php" method="POST">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" placeholder="Digite seu usuário" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>

                <button type="submit">Entrar</button>
            </form>

            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
        </div>
    </div>
</body>
</html>

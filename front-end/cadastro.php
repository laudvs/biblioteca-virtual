<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - BookLovers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <div class="container">
            <h2>Cadastre-se</h2>

            <!-- Local onde a mensagem do PHP será exibida -->
            <?php if (isset($_SESSION['message'])): ?>
                <p class="msg"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
            <?php endif; ?>

            <form action="../back-end/cadastro_process.php" method="POST">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" placeholder="Digite seu usuário" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>

                <label for="confirm_password">Confirmar Senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme sua senha" required>

                <button type="submit">Cadastrar</button>
            </form>

            <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
        </div>
    </div>
</body>
</html>

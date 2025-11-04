<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $senha = $_POST['password'];
    $confirm_senha = $_POST['confirm_password'];

    if ($senha !== $confirm_senha) {
        $_SESSION['message'] = "As senhas não coincidem!";
        header("Location: ../front-end/cadastro.php");
        exit();
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se o email já existe
    $check = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Email já cadastrado!";
        header("Location: ../front-end/cadastro.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO usuarios (username, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hash);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Cadastro realizado com sucesso! Faça login.";
        header("Location: ../front-end/login.php");
    } else {
        $_SESSION['message'] = "Erro ao cadastrar usuário.";
        header("Location: ../front-end/cadastro.php");
    }
}
?>

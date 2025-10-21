<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $senha = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['username'];
            header("Location: ../front-end/index.html");
            exit();
        } else {
            $_SESSION['message'] = "Senha incorreta!";
        }
    } else {
        $_SESSION['message'] = "Usuário não encontrado!";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../front-end/login.html");
    exit();
}
?>

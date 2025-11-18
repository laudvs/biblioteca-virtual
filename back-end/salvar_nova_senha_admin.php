<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['admin_id_temp'])) {
    die("Acesso negado!");
}

$id = (int) $_SESSION['admin_id_temp'];
$nova = isset($_POST['nova_senha']) ? trim($_POST['nova_senha']) : '';
$confirma = isset($_POST['confirmar_senha']) ? trim($_POST['confirmar_senha']) : '';

if ($nova === '' || $confirma === '') {
    die("Campos de senha não informados!");
}

if ($nova !== $confirma) {
    die("As senhas não coincidem!");
}

$hash = password_hash($nova, PASSWORD_DEFAULT);

// Usando mysqli (conexão definida em conexao.php como $conn)
$stmt = $conn->prepare("UPDATE usuarios SET senha = ?, primeiro_acesso = 0 WHERE id = ?");
if ($stmt === false) {
    die('Erro na preparação da query: ' . $conn->error);
}
$stmt->bind_param('si', $hash, $id);
$executed = $stmt->execute();

if (!$executed) {
    die('Erro ao atualizar senha: ' . $stmt->error);
}

$stmt->close();
unset($_SESSION['admin_id_temp']);

$_SESSION['message'] = "Senha alterada com sucesso! Faça login novamente.";
header("Location: ../front-end/login.php");
exit;
?>

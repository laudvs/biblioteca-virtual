<?php
session_start();

// Conexão 🗂️
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booklovers";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se os campos vieram via POST
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    $_SESSION['message'] = "Preencha todos os campos!";
    header("Location: http://localhost/booklovers/front-end/login.php");
    exit();
}

$username_input = trim($_POST['username']);
$password_input = trim($_POST['password']);
$logarComoAdmin = isset($_POST['login_admin']); // checkbox admin (nome no formulário)

// Consulta usuário
$sql = "SELECT * FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username_input);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se usuário existe
if ($result->num_rows > 0) {

    $usuario = $result->fetch_assoc();

    // ================================
    // LOGIN COMO ADMINISTRADOR 👑
    // ================================
    if ($logarComoAdmin) {

        // Verifica se é admin
        if ($usuario['tipo'] !== 'admin') {
            $_SESSION['message'] = "Este usuário não é administrador!";
            header("Location: http://localhost/booklovers/front-end/login.php");
            exit();
        }

        // Verifica senha
        if (!password_verify($password_input, $usuario['senha'])) {
            $_SESSION['message'] = "Senha do administrador incorreta!";
            header("Location: http://localhost/booklovers/front-end/login.php");
            exit();
        }

        // Força mudança de senha no primeiro acesso
        if ($usuario['primeiro_acesso'] == 1) {
            // armazena id temporário para troca de senha
            $_SESSION['admin_id_temp'] = $usuario['id'];
            header("Location: http://localhost/booklovers/front-end/mudar_senha_admin.php");
            exit();
        }

        // Login OK → criar sessão de admin
        $_SESSION['admin'] = $usuario['username'];
        $_SESSION['id_admin'] = $usuario['id'];

        header("Location: http://localhost/booklovers/front-end/admin.php");
        exit();
    }


    // ================================
    // LOGIN NORMAL (usuário comum)
    // ================================
    if (password_verify($password_input, $usuario['senha'])) {

        $_SESSION['usuario'] = $usuario['username'];
        $_SESSION['id_usuario'] = $usuario['id'];

        $stmt->close();
        $conn->close();

        header("Location: http://localhost/booklovers/front-end/index.php");
        exit();

    } else {
        $_SESSION['message'] = "Senha incorreta!";
        header("Location: http://localhost/booklovers/front-end/login.php");
        exit();
    }

} else {

    $_SESSION['message'] = "Usuário não encontrado!";
    header("Location: http://localhost/booklovers/front-end/login.php");
    exit();
}
?>

<?php
session_start();

if (!isset($_SESSION['admin_id_temp'])) {
    die("Acesso negado!");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar Senha - Administrador</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container-wrapper {
            width: 100%;
            max-width: 500px;
        }

        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-of-type {
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 12px;
            color: #667eea;
            pointer-events: none;
            font-size: 16px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            color: #667eea;
            font-size: 18px;
            padding: 0;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #764ba2;
        }

        .buttons-container {
            display: flex;
            gap: 15px;
            flex-direction: column;
        }

        button {
            padding: 13px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .info-box {
            background: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 13px;
            color: #555;
            line-height: 1.6;
        }

        .info-box i {
            color: #667eea;
            margin-right: 8px;
        }

        .strength-meter {
            margin-top: 8px;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            background: #ff6b6b;
            transition: all 0.3s ease;
        }

        .strength-text {
            font-size: 12px;
            margin-top: 4px;
            color: #666;
        }

        /* Responsivo */
        @media (max-width: 600px) {
            .form-container {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            input[type="password"],
            input[type="text"] {
                padding: 11px 12px 11px 35px;
                font-size: 16px; /* Evita zoom em iOS */
            }

            button {
                padding: 12px 18px;
                font-size: 14px;
            }

            .buttons-container {
                flex-direction: column;
            }
        }

        @media (max-width: 360px) {
            .form-container {
                padding: 25px 15px;
            }

            .header h1 {
                font-size: 20px;
            }

            .header p {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container-wrapper">
        <div class="form-container">
            <div class="header">
                <h1><i class="fas fa-lock"></i> Primeira Troca de Senha</h1>
                <p>Você deve alterar sua senha de administrador antes de continuar. Escolha uma senha forte!</p>
            </div>

            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <strong>Dica de segurança:</strong> Use uma senha com pelo menos 8 caracteres, incluindo letras, números e símbolos.
            </div>

            <form action="../back-end/salvar_nova_senha_admin.php" method="POST" id="formSenha">
                <div class="form-group">
                    <label for="nova_senha"><i class="fas fa-key"></i> Nova Senha</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="nova_senha" 
                            name="nova_senha" 
                            placeholder="Digite sua nova senha"
                            required
                            minlength="6"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('nova_senha')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="strength-meter">
                        <div class="strength-bar" id="strengthBar1"></div>
                    </div>
                    <div class="strength-text" id="strengthText1"></div>
                </div>

                <div class="form-group">
                    <label for="confirmar_senha"><i class="fas fa-key"></i> Confirmar Senha</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="confirmar_senha" 
                            name="confirmar_senha" 
                            placeholder="Confirme sua nova senha"
                            required
                            minlength="6"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('confirmar_senha')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="buttons-container">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-check"></i> Salvar Nova Senha
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const isPassword = field.type === 'password';
            field.type = isPassword ? 'text' : 'password';
            
            const button = event.target.closest('button');
            const icon = button.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            return strength;
        }

        const senhaInput = document.getElementById('nova_senha');
        const strengthBar = document.getElementById('strengthBar1');
        const strengthText = document.getElementById('strengthText1');

        senhaInput.addEventListener('input', function() {
            const strength = checkPasswordStrength(this.value);
            const width = (strength / 4) * 100;
            
            strengthBar.style.width = width + '%';
            
            const colors = ['#ff6b6b', '#ffa500', '#ffd700', '#51cf66'];
            const texts = ['Fraca', 'Regular', 'Boa', 'Forte'];
            
            strengthBar.style.background = colors[strength - 1] || '#e0e0e0';
            strengthText.textContent = strength > 0 ? `Força: ${texts[strength - 1]}` : '';
        });

        document.getElementById('formSenha').addEventListener('submit', function(e) {
            const nova = document.getElementById('nova_senha').value;
            const confirma = document.getElementById('confirmar_senha').value;

            if (nova !== confirma) {
                e.preventDefault();
                alert('❌ As senhas não coincidem!');
                return false;
            }

            if (nova.length < 6) {
                e.preventDefault();
                alert('❌ A senha deve ter pelo menos 6 caracteres!');
                return false;
            }
        });
    </script>
</body>
</html>

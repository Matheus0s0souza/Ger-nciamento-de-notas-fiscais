<?php
session_start();
require_once "conexao.php";

$erro = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome  = $mysqli->real_escape_string($_POST["nome"]);
    $senha = $mysqli->real_escape_string($_POST["senha"]);

    if (empty($nome) || empty($senha)) {
        $erro[] = "Preencha todos os campos.";
    } else {

        $sql = "SELECT * FROM usuario WHERE nome = '$nome' LIMIT 1";
        $result = $mysqli->query($sql);

        if ($result->num_rows === 1) {
            $usuario = $result->fetch_assoc();

        
            if ($senha === $usuario["senha"]) {

                $_SESSION["id"]   = $usuario["id"];
                $_SESSION["nome"] = $usuario["nome"];

                header("Location: dashboard.php");
                exit;

            } else {
                $erro[] = "Senha incorreta.";
            }
        } else {
            $erro[] = "Usuário não encontrado.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Login do Entregador</title>
<style>
body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #efefef;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 40px 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        width: 350px;
        text-align: center;
    }

    h1 {
        color: #8b0000;
        margin-bottom: 25px;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 12px 10px;
        margin: 10px 0;
        border: 1px solid #8b0000;
        border-radius: 5px;
        font-size: 16px;
    }

    input:focus {
        outline: none;
        border-color: #8b0000;
        box-shadow: 0 0 5px #8b0000;
    }

    button {
        width: 100%;
        padding: 12px;
        margin-top: 15px;
        border: none;
        border-radius: 5px;
        background-color: #8b0000;
        color: #efefef;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #a50000;
    }

    .error-message {
        color: #8b0000;
        margin-top: 10px;
        font-size: 14px;
        display: none;
    }
</style>
</head>
<body>

<div class="container">

<?php
if (!empty($erro)) {
    foreach ($erro as $msg) {
        echo "<p style='color:#8b0000;'>$msg</p>";
    }
}
?>

<form method="POST">
    <h1>Login do Entregador</h1>
    <input type="text" name="nome" placeholder="Usuário" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>

</div>
</body>
</html>
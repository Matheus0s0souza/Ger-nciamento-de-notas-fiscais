<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Envio de Nota Fiscal</title>




<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        width: 350px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    button {
        margin-top: 15px;
        width: 100%;
        padding: 10px;
        background-color: #8b0000; /* vermelho escuro */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #6e0000; /* tom mais escuro no hover */
    }
</style>
</head>
<body>

<div class="container">
    <h2>Enviar Nota Fiscal</h2>

    <form action="upload.php" method="POST" enctype="multipart/form-data">

        <!-- Campo Imagem AGORA PRIMEIRO -->
        <label for="imagem">Selecionar imagem da nota:</label>
        <input type="file" name="imagem" id="imagem" accept="image/*" required>

        <!-- Campo Código NF -->
        <label for="codigo_nf">Código NF:</label>
        <input type="text" name="codigo_nf" id="codigo_nf" required>

        <button type="submit">Enviar</button>

    </form>
</div>

</body>
</html>
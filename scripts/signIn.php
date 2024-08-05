<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="styles/signIn.css">
    <title>Login - YouTube</title>
    <style>
        span{

            color: #cc0000;
        
            }
            body{

                display: flex;
                flex-direction: column;
                gap: 20px;

            }
    </style>
</head>
<body>
    <div class="container">
        <img src="img/Youtube-Logo.png" alt="YouTube Logo">
        <h2>Faça login na sua conta</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
        <a href="signUp.php" class="link">Não tem uma conta? Cadastre-se</a>
    </div>

    <?php

        $hostname = 'localhost';
        $bancodedados = "youtube";
        $usuario = "root";
        $senha = "";

        $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

        if ($mysqli->connect_errno) {
            echo "CONEXÃO FALHOU: " . $mysqli->connect_errno . " - " . $mysqli->connect_error;
        } else {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $senha = $_POST['password'];

                $sql = "SELECT email, senha , nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        /*echo "Nome: " . $row["nome"] . "<br>";
                        echo "Email: " . $row["email"] . "<br>";*/
                        $nome = $row["nome"];
                        

                        echo "<script>
                            document.location.href = 'home.php';
                        </script>";

                    }
                } else {
                    echo "<span>Email ou senha inválidos.</span>";
                }
            }
        }

        $mysqli->close();


    ?>
</body>
</html>

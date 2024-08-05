<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="styles/sigUp.css">
    <title>Cadastro - YouTube</title>
    <style>

            span{

            color: #cc0000;

            }
            body{

                display: flex;
                flex-direction: column;
                gap: 10px;

            }
    </style>
</head>
<body>
    <div class="container">
        <img src="img/Youtube-Logo.png" alt="YouTube Logo">
        <h2>Crie sua conta</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="firstname">Primeiro Nome</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Último Nome</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirmar Senha</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <button type="submit" class="btn" name="btn" >Cadastrar</button>
        </form>
        <a href="signIn.php" class="link">Já tem uma conta? Faça login</a>
    </div>
    <?php
    if(isset($_POST['btn'])){

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirm-password'];


        if($password != $confirmPass){

            echo "<span>As Senhas não correspondem</span>";

        }else{

            $hostname = 'localhost';
            $bancodedados = "youtube";
            $usuario = "root";
            $senha = "";

            $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

            if ($mysqli->connect_errno) {
                echo "CONEXÃO FALHOU: " . $mysqli->connect_errno . " - " . $mysqli->connect_error;
            } else {
                $sql = "INSERT INTO usuarios (id , nome , lastname, email , senha) VALUES (default, '$firstname' , '$lastname' , '$email ' , '$password')";

                if ($mysqli->query($sql) === TRUE) {

                    //echo "<script>alert('Dados cadastrados!')</script>";
                    
                    echo "<script>
                            document.location.href = 'profile.php';
                        </script>";

                } else {
                    echo "Erro ao cadastrar: " . $mysqli->error;
                }
            }

            $mysqli->close();
        }
    }
    
    ?>
</body>
</html>

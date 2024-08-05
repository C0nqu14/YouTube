<?php

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
        echo "<script>alert('Dados cadastrados!')</script>";
    } else {
        echo "Erro ao cadastrar: " . $mysqli->error;
    }
}

$mysqli->close();

//SELECT 


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


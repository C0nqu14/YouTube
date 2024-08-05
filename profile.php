<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header('Location: login.php');
    exit();
}

$uploadError = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);

    if ($check !== false) {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $hostname = 'localhost';
            $bancodedados = "youtube";
            $usuario = "root";
            $senha = "";

            $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

            if ($mysqli->connect_errno) {
                echo "CONEXÃO FALHOU: " . $mysqli->connect_errno . " - " . $mysqli->connect_error;
            } else {
                $email = $mysqli->real_escape_string($_SESSION['email']);
                $sql = "UPDATE usuarios SET imagem_perfil = '$target_file' WHERE email = '$email'";
                if ($mysqli->query($sql) === TRUE) {
                    $_SESSION['imagem_perfil'] = $target_file;
                    echo "<p class='success'>Imagem de perfil atualizada com sucesso!</p>";
                } else {
                    echo "<p class='error'>Erro ao atualizar a imagem: " . $mysqli->error . "</p>";
                }
                $mysqli->close();
            }
        } else {
            $uploadError = "Desculpe, houve um erro ao fazer o upload da sua imagem.";
        }
    } else {
        $uploadError = "Arquivo não é uma imagem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/profile.css">
    <title>Perfil</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Carregar Imagem de Perfil</h1>
        </header>
        <main>
            <form action="profile.php" method="post" enctype="multipart/form-data">
                <label for="profile_image" class="upload-label">
                    <img src="img/icons8-fazer-upload-50.png" alt="Upload Icon">
                    Escolha uma imagem
                </label>
                <input type="file" name="profile_image" id="profile_image" required>
                <button type="submit">Carregar</button>
            </form>
            <?php if ($uploadError): ?>
                <p class="error"><?php echo $uploadError; ?></p>
            <?php endif; ?>
        </main>
        <footer>
            <a href="home.php">Voltar para Home</a>
        </footer>
    </div>
</body>
</html>

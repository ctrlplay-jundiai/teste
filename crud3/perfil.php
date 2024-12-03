<?php
    session_start();
    include("conexao.php");

    if(!isset($_SESSION['id'])){
        header("Location: login.html");
        exit;
    }

    $userID = $_SESSION['id'];
    $username = $_SESSION['user'];
    $sql = "SELECT bio,location,birthdate FROM profiles 
    WHERE user_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$userID]);
    $profile = $stmt->fetch();
    //if($stmt->rowCount()!=1){
    //    $_SESSION['user']= $username;
    //    $_SESSION['id'] = $id;
    //    header("Location: profile_update.php");
    //}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" type = "text/css" href="estilo.css">
</head>
<body>
    <header>
        <h1> Bem-vindo ao Seu Perfil</h1>
        <nav>
            <ul>
                <li><a href="index.html"> Página Inicial</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="list_posts.php">Posts</a></li>
                <li><a href="create_post.php">Criar Post</a></li>
            </ul>
        </nav>
    </header>
    <div class="perfil">
        <p>Nome de Usuário: <?php echo $username; ?></p>
        <p>Bio: <?php echo $profile['bio']; ?> </p>
        <p>Localização: <?php echo $profile['location']; ?> </p>
        <p>Data de Nascimento: <?php echo $profile['birthdate']; ?> </p>
        <a href='profile_update.php'><button>EDITAR PERFIL</button></a>
    </div>

</body>
</html>
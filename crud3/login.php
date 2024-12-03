<?php
    session_start();
    include("conexao.php");

    $username = $_POST["username"];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE 
    username = :username";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':username',$username);
    $stmt->execute();
    
    if($stmt->rowCount() == 1){
        $user = $stmt->fetch();
        if(password_verify($password,$user['password'])){
            $_SESSION["user"] = $username;
            $_SESSION["id"] = $user["id"];
            header("Location: perfil.php");
            exit;
        }
        else{
            echo "Senha Incorreta!";
            header("Location: login.html");
            exit;
        }
    }else{
        echo "Usuário não encontrado...";
        header("Location: login.html");
        exit;
    }

?>
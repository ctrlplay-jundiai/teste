<?php
    include 'conexao.php';

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $niver = $_POST['niver'];
        $local = $_POST['local'];
        $bio = $_POST['bio'];

        $sql = "INSERT INTO users(username,email,password) VALUES(?,?,?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$username,$email,$password]);

        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":username",$username);
        $stmt->execute();
        $id = 0;
        if($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            echo $user['password'];
            echo $password;
            if(password_verify($_POST['password'],$user['password'])){
                $id = $user['id'];
            }
        }
        
        $sql = "INSERT INTO profiles(user_id,bio,location,birthdate) VALUES(?,?,?,?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$id,$bio,$local,$niver]);

        echo "Usuário Registrado com sucesso!";
        header("Location: index.html");

    }else{
        echo "Erro de conexao!";
        header("Location: index.html");
    }

?>
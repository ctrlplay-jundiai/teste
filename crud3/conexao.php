<?php
    $endereco = "localhost";
    //Coloque o seu nome de usuário e senha usados no seu SGBD.
    $nomeDoBD = "crud3";
    $nomeDeUsuario = "root";
    $senha = "";
    $conexao;
    try {
        $conexao = new PDO("mysql:host=$endereco;dbname=$nomeDoBD", $nomeDeUsuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     
    }
    catch(PDOException $e)    {
        echo "Conex�o falhou: " . $e->getMessage();
    }   
    //$conexao = null;  
?>
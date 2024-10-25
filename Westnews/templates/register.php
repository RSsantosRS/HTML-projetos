<?php
    // register.php

    // Conectar ao banco de dados
    $db = new SQLite3('westnewsDB.db');

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // var_dump($_POST);

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_nasc = $_POST['data_nasc'];
        $campus = $_POST['campus'];
        $matricula = $_POST['matricula'];
        $senha = $_POST['senha']; // Alterado para 'senha'
        $confirmSenha = $_POST['confirm_password']; // Consistente com o formulário

        // Verifica se a senha e a confirmação são iguais
        if ($senha !== $confirmSenha) { // Alterado para usar '$senha'
            die("As senhas não coincidem.");
        }

        // Hash da senha
        $hashedSenha = password_hash($senha, PASSWORD_DEFAULT); // Alterado para '$senha'

        // Prepara a consulta para evitar SQL Injection
        $stmt = $db->prepare('INSERT INTO usuarios (nome, email, data_nasc, campus, matricula, senha) VALUES (:nome, :email, :data_nasc, :campus, :matricula, :senha)');
        $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':data_nasc', $data_nasc, SQLITE3_TEXT);
        $stmt->bindValue(':campus', $campus, SQLITE3_TEXT);
        $stmt->bindValue(':matricula', $hashedSenha, SQLITE3_TEXT);
        $stmt->bindValue(':senha', $hashedSenha, SQLITE3_TEXT);

        // Executa a consulta
        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o usuário: " . $db->lastErrorMsg();
        }
    }

    // Fecha a conexão
    $db->close();
?>
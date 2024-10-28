<?php
// Conectando ao banco de dados SQLite
$db = new SQLite3('westnewsDB.db'); // Substitua pelo caminho correto do seu banco de dados

// Verificando se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug: Mostrando o conteúdo de $_POST
    ////////var_dump($_POST); // Adicione isso para ver o que está sendo enviado

    $email = $_POST['email'] ?? null; // Coalescência nula
    $senha = $_POST['senha'] ?? null; // Agora o campo correto

    // Certifique-se de que ambos os campos estão preenchidos
    if (empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
        exit();
    }

    // Prepare a consulta SQL
    $stmt = $db->prepare('SELECT * FROM usuarios WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);

    // Executa a consulta
    $result = $stmt->execute();

    
    // Verifica se encontrou um usuário
    if ($user = $result->fetchArray(SQLITE3_ASSOC)) {
        // Debug: Mostrando o array do usuário
        //var_dump($user); // Remova isso em produção

        // Se a senha estiver correta, redireciona para index.html
        if (password_verify($senha, $user['senha'])) {
            header('Location: indexPOS.html');
            exit();
        } else {
            echo "<script>
            alert('Credenciais inválidas!');
            window.location.href = 'login.html';
          </script>";
        }
    } else {
        echo "Credenciais inválidas!";
    }
}
?>
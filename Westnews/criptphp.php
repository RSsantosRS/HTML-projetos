<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Função para criptografar a senha
    function criptografarSenha($senha) {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    // Verifica se todos os campos foram preenchidos
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        try {
            // Conectando ao banco de dados SQLite
            $pdo = new PDO('sqlite:westnewsDB.db');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cria a tabela se ainda não existir
            $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
                id INTEGER PRIMARY KEY,
                nome TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                senha TEXT NOT NULL
            )");

            // Criptografa a senha
            $senhaCriptografada = criptografarSenha($senha);

            // Prepara a query para inserir o usuário no banco de dados
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");

            // Executa a query com os parâmetros
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senhaCriptografada
            ]);

            echo "Usuário cadastrado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>

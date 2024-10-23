<?php
// Função para criptografar a senha
function criptografarSenha($senha) {
    // Utiliza o algoritmo de hash padrão do PHP (bcrypt) para criptografar a senha
    return password_hash($senha, PASSWORD_DEFAULT);
}

// Conectando ao banco de dados SQLite
try {
    // Conexão com o banco de dados SQLite (o arquivo será criado se não existir)
    $pdo = new PDO('sqlite:meu_banco.db');
    // Configurando o modo de erro para lançar exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria uma tabela se ainda não existir
    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY,
        nome TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        senha TEXT NOT NULL
    )");

    // Dados de exemplo
    $nome = 'rafael';
    $email = 'rafael@gmail.com';
    $senha = '12345';

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

    echo "Usuário inserido com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>
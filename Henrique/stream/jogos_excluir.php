<?php
require_once ("util/Conexao.php");
require_once ("livros.php");
// 1- Identificar o livro que vai ser excluído


// 2- Validar se o id do livro foi recebido
$id = 0;
if (isset($_GET['id']))
    $id = $_GET['id'];

if ($id > 0) {
// 3- Excluir o livro do banco de dados
$conexao = Conexao::getConexao();

$sql = "DELETE FROM livros WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->execute([$id]);

// 4- Redirecionar para a listagem de livros
header("Location: livros.php");
} else {
    echo "Parâmetro ID invalido!!<br>";
    echo "<a href='livros.php'>Voltar</a>";
}
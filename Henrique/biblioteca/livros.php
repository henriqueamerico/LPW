<?php

// exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();
//print_r($conexao);
if (isset($_POST['titulo'])) {
    // 1- receber os dados do formulário
    $titulo = trim($_POST['titulo']) ? trim($_POST['titulo']) : null;
    $genero = trim($_POST['genero']) ? trim($_POST['genero']) : null;
    $qtdPag = is_numeric($_POST['paginas']) ? $_POST['paginas'] : null;
    $autor = trim($_POST['autor']) ? trim($_POST['autor']) : null;




    $qtdPag = $_POST['paginas'];
    $autor = $_POST['autor'];

    // 1.1 - Validar os dados



    //echo $titulo . " - " . $genero . " - " . $qtdPag;

    // 2- Inserir o livro no banco de dados
    $sql = "INSERT INTO livros (titulo, genero, qtd_paginas, autor)
            VALUES (? , ? , ? , ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$titulo, $genero, $qtdPag, $autor]);

    // 3- Redirecionar para a página de listagem
    header("Location: livros.php");
}

// Listagem dos livros
$sql = "SELECT * FROM livros";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$livros = $stmt->fetchAll();

//echo "<pre>" . print_r($livros, true) . "</pre>";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de livros</title>
</head>

<body>

    <h1>Cadastro de livros</h1>

    <h3>Listagem</h3>

    <table border="1">
        <!-- cabeçalho -->
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Páginas</th>
            <th>Autor</th>
        </tr>

        <!-- Dados -->
        <?php foreach ($livros as $l): ?>
            <tr>
                <td><?= $l["id"] ?></td>
                <td><?= $l["titulo"] ?></td>

                <td>
                    <?php
                    switch ($l["genero"]) {
                        case "D":
                            echo "Drama";
                            break;
                        case "F":
                            echo "Ficção";
                            break;
                        case "R":
                            echo "Romance";
                            break;

                        default:
                            echo "Outro";
                    }
                    ?>
                </td>
                <td><?= $l["qtd_paginas"] ?></td>
                <td><?= $l["autor"] ?></td>

                <td>
                    <a href="livros_excluir.php?id=<?= $l['id'] ?>"
                        onclick="if (! confirm('Você jura pela vida da sua mãe que vc quer excluir?')) return false">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <h3>Formulário</h3>
    <!-- <form action="" method="POST" onsubmit="return validarForm();"> -->
    <form action="" method="POST">

        <input type="text" placeholder="Informe o título"
            name="titulo" id="titulo">

        <br><br>

        <select name="genero" id="genero">
            <option value="">---Selecione o gênero---</option>
            <option value="D">Drama</option>
            <option value="F">Ficção</option>
            <option value="R">Romance</option>
        </select>

        <br><br>

        <input type="number" name="paginas" id="paginas"
            placeholder="Informe o número de páginas">

        <br><br>

        <input type="text" placeholder="Informe o Autor"
            name="autor" id="autor">

        <br><br>

        <button>Enviar</button>

    </form>

    <div id="msgErro" style="color: red; display: none;">
        Exemplo de erro!
    </div>

    <script src="validacao.js"></script>

</body>

</html>

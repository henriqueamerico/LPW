<?php

// exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once ("util/Conexao.php");

$conexao = Conexao::getConexao();
//print_r($conexao);

// Salvar o livro


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
         </tr>

         <!-- Dados -->
          <?php foreach($livros as $l): ?>
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
            </tr>
        <?php endforeach; ?>

    </table>

    <h3>Formulário</h3>
    <form action="" method="POST">

    <input type="text" placeholder="Informe o título"
    name="titulo">

    <br><br>

    <select name="genero">
        <option value="">---Selecione o gênero---</option>
        <option value="D">Drama</option>
        <option value="F">Ficção</option>
        <option value="R">Romance</option>
    </select>

    <br><br>

    <input type="number" name= "paginas"
    placeholder="Informe o número de páginas">

    <br><br>

    <button>Enviar</button>

    </form>
    
</body>
</html>
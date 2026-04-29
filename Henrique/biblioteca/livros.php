<?php

// exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once ("util/Conexao.php");

$conexao = Conexao::getConexao();
//print_r($conexao);

// Salvar o livro
if(isset($_POST['titulo'])) {
    // 1- receber os dados do formulário
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $qtdPag = $_POST['paginas'];
    $autor = $_POST['autor'];

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
                <td><?= $l["autor"] ?></td> 
            
            <td>
                <a href="livros_excluir.php?id=<?= $l['id'] ?>"
                        onclick="if (! confirm('Você jura pela vida da sua mãe que vc quer excluir?')) return false"
                    >Excluir</a>
            </td>
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

    <input type="text" placeholder="Informe o Autor"
    name="autor">

    <br><br>

    <button>Enviar</button>

    </form>
    
</body>
</html>

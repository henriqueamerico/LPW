    <?php

// exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();
//print_r($conexao);

$msgErro = "";

$nome = "";
$genero = "";
$qtdPag = "";
$desenvolvedora = "";

if (isset($_POST['nome'])) {
    // 1- receber os dados do formulário
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $genero = trim($_POST['genero']) ? trim($_POST['genero']) : null;
    $qtdPag = is_numeric($_POST['paginas']) ? $_POST['paginas'] : null;
    $desenvolvedora = trim($_POST['desenvolvedora']) ? trim($_POST['desenvolvedora']) : null;

    // ver se o nome já existe
    $sql = "SELECT nome FROM livros WHERE nome = ?";
    $stm = $conexao->prepare($sql);
    $stm->execute([$nome]);
    $verificador = $stm->fetchAll();




    $qtdPag = $_POST['paginas'];
    $desenvolvedora = $_POST['desenvolvedora'];

    // 1.1 - Validar os dados
    $msgs = array();
    if(! $nome){
        array_push($msgs, "Informe o título!!");
    } else if (strlen($nome) < 2 || strlen($nome) > 50) { 
        array_push($msgs, "O título deve conter entre 2 e 50 caracteres!!");

    } else if ($verificador) {
        array_push($msgs, "Esse título já existe!!");
    }

    if(! $genero)
        array_push($msgs, "Informe o gênero!!");

    if(! $qtdPag)
        array_push($msgs, "Informe o número de paginas!!");

    if(! $desenvolvedora)
        array_push($msgs, "Informe o desenvolvedora!!");

    if(empty($msgs)) {
        
   // 2- Inserir o livro no banco de dados
    $sql = "INSERT INTO livros (nome, genero, qtd_paginas, desenvolvedora)
            VALUES (? , ? , ? , ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$nome, $genero, $qtdPag, $desenvolvedora]);

    // 3- Redirecionar para a página de listagem
    header("Location: livros.php");

    } else {
        // Exibir as msg de erro
        $msgErro = implode("<br>", $msgs);
        
    }


    
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
            <th>desenvolvedora</th>
        </tr>

        <!-- Dados -->
        <?php foreach ($livros as $l): ?>
            <tr>
                <td><?= $l["id"] ?></td>
                <td><?= $l["nome"] ?></td>

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
                <td><?= $l["desenvolvedora"] ?></td>

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
            name="nome" id="nome"
            value="<?= $nome ?>"> 

        <br><br>

        <select name="genero" id="genero">
            <option value="">---Selecione o gênero---</option>
            <option value="D" <?= $genero == "D" ? "selected" : "" ?> >
                Drama</option> 
            <option value="F" <?= $genero == "F" ? "selected" : "" ?>>
                Ficção</option>
            <option value="R" <?= $genero == "R" ? "selected" : "" ?>>
                Romance</option>
            <option value="O" <?= $genero == "O" ? "selected" : "" ?>>
                Outro</option>
            

            
        </select>  
 
        <br><br>

        <input type="number" name="paginas" id="paginas"
            placeholder="Informe o número de páginas"
            value="<?= $qtdPag ?>"> 

        <br><br>

        <input type="text" placeholder="Informe o desenvolvedora"
            name="desenvolvedora" id="desenvolvedora"
            value="<?= $desenvolvedora ?>"> 

        <br><br>

        <button>Enviar</button>

    </form>

    <div id="msgErro" style="color: red; display: none;">
        Exemplo de erro!
    </div>

    <div style="color: red;">
        <?= $msgErro ?>
    </div>
                        
    <script src="validacao.js"></script>

</body>

</html>
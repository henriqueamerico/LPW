

<?php

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();

// EXCLUIR JOGO
$id = $_GET['id'] ?? 0;

if ($id > 0) {

    $sql = "DELETE FROM jogos WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$id]);

    header("Location: jogos_excluir.php");
    exit;
}

// LISTAR JOGOS
$sql = "SELECT * FROM jogos ORDER BY nome";
$stmt = $conexao->prepare($sql);
$stmt->execute();

$jogos = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Excluir</title>
    <link rel="icon" type="image/png" href="https://raw.githubusercontent.com/NestorRauber/imgDeSites/refs/heads/main/0.png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #1b2838;
            color: white;
        }

        .conteudo {
            padding: 30px;
        }

        h1 {
            margin-bottom: 20px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            background: #16202d;
            overflow: hidden;
            border-radius: 10px;
        }

        th {
            background: #2a475e;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        tr:hover {
            background: rgba(255, 255, 255, .03);
        }

        img {
            width: 150px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
        }

        .btn-excluir {
            background: #d9534f;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-excluir:hover {
            background: #c9302c;
        }
    </style>

</head>

<body>

    <?php include("menu&roda/menu.php"); ?>

    <div class="conteudo">

        <h1>Excluir Jogos</h1>


        <table>

            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Desenvolvedora</th>
                <th>Preço</th>
                <th>Ação</th>
            </tr>

            <?php foreach ($jogos as $j): ?>

                <tr>

                    <td><?= $j['id'] ?></td>

                    <td>
                        <img src="<?= $j['img'] ?>" alt="">
                    </td>

                    <td><?= $j['nome'] ?></td>

                    <td><?= $j['dev'] ?></td>

                    <td>
                        R$ <?= number_format($j['preco'], 2, ",", ".") ?>
                    </td>

                    <td>
                        <a
                            class="btn-excluir"
                            href="jogos_excluir.php?id=<?= $j['id'] ?>"
                            onclick="return confirm('Deseja realmente excluir <?= addslashes($j['nome']) ?>?')">
                            Excluir
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

        </table>

    </div>

    <?php include("menu&roda/rodape.php"); ?>

</body>

</html>


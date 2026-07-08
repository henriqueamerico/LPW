

<?php

// exibir erros
ini_set('display_erros', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();


$nome = "";
$genero = "";
$preco = "";
$dev = "";
$classi = "";
$img = "";

if (isset($_POST['nome'])) {
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $genero = trim($_POST['genero']) ? trim($_POST['genero']) : null;
    $preco = trim($_POST['preco']) ? trim($_POST['preco']) : null;
    $dev = trim($_POST['dev']) ? trim($_POST['dev']) : null;
    $classi = trim($_POST['classi']) ? trim($_POST['classi']) : null;
    $img = trim($_POST['img']) ? trim($_POST['img']) : null;

    // ver se o jogo ja existe
    $sql = "SELECT nome FROM jogos WHERE nome = ?";
    $stm = $conexao->prepare($sql);
    $stm->execute([$nome]);
    $verificador = $stm->fetchAll();




    $preco = $_POST['preco'];
    $dev = $_POST['dev'];

    // 1.1 - Validar os dados
    $msgs = array();

    if (! $nome) {
        $msgs['nome'] = "Informe o nome!!";
    } else if (strlen($nome) < 2 || strlen($nome) > 50) {
        $msgs['nome'] = "O nome deve conter entre 2 e 50 caracteres!!";
    } else if ($verificador) {
        $msgs['nome'] = "Esse nome já existe!!";
    }

    if (! $genero)
        $msgs['genero'] = "Informe o gênero!!";

    if ($preco === "" || $preco === null) {
        $msgs['preco'] = "Informe o preço!!";
    } else if ($preco < 0) {
        $msgs['preco'] = "O preço não pode ser negativo!!";
    }

    if (! $dev)
        $msgs['dev'] = "Informe a desenvolvedora!!";

    if (! $classi)
        $msgs['classi'] = "Informe o classificação!!";

    if (! $img)
        $msgs['img'] = "Informe a imagem!!";

    if (empty($msgs)) {

        // 2- Inserir o jogo no banco de dados
        $sql = "INSERT INTO jogos (nome, genero, preco, dev, classi, img)
            VALUES (? , ? , ? , ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$nome, $genero, $preco, $dev, $classi, $img]);

        // 3- Redirecionar para a página de listagem
        header("Location: catalogo.php");
    }
}

// Listagem dos jogos
$sql = "SELECT * FROM jogos";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$jogos = $stmt->fetchAll();

//echo "<pre>" . print_r($jogos, true) . "</pre>";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="icon" type="image/png" href="https://raw.githubusercontent.com/NestorRauber/imgDeSites/refs/heads/main/0.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: radial-gradient(circle at top, #2a475e 0%, #1b2838 35%, #0f1923 100%);
            color: white;
        }

        .conteudo {
            padding: 30px;
        }

        h1 {
            margin-bottom: 25px;
            font-size: 36px;
        }

        h3 {
            margin: 25px 0 15px;
            color: #66c0f4;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            background: #16202d;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        th {
            background: #2a475e;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        tr:hover {
            background: rgba(255, 255, 255, .03);
        }

        img {
            border-radius: 5px;
        }

        form {
            background: #16202d;
            padding: 25px;
            border-radius: 10px;
            width: 60%;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #2a475e;
            color: white;
            font-size: 15px;
        }

        input::placeholder {
            color: #c7d5e0;
        }

        button {
            background: #66c0f4;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s;
        }

        button:hover {
            transform: translateY(-2px);
        }

        a[href*="jogos_excluir"] {
            background: #d9534f;
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
        }

        a[href*="jogos_excluir"]:hover {
            background: #c9302c;
        }

        .msg-erro {
            margin-top: 20px;
            color: #ff6b6b;
            font-weight: bold;
        }

        .erro {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .area-cadastro {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 30px;
        }

        .preview {
            width: 40%;
            min-width: 300px;
            background: #16202d;
            border-radius: 10px;
            padding: 20px;
        }

        .preview img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .preview h2 {
            margin-bottom: 10px;
        }

        .preview p {
            margin-bottom: 8px;
            color: #c7d5e0;
        }

        .previewPreco {
            margin-top: 15px;
            font-size: 28px;
            color: #66c0f4;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include("menu&roda/menu.php"); ?>

    <div class="conteudo">

        <h1>Cadastro de jogos</h1>

        <h3>Listagem</h3>

        <table border="1">
            <!-- cabeçalho -->
            <tr>
                <th>Nome</th>
                <th>Imagem</th>
            </tr>

            <!-- Dados -->
            <?php foreach ($jogos as $j): ?>
                <tr>
                    <td><?= $j["nome"] ?></td>
                    <td>
                        <img src="<?= $j["img"] ?>" alt="<?= $j["nome"] ?>" width="100">
                    </td>

                </tr>
            <?php endforeach; ?>

        </table>

        <h3>Formulário</h3>

        <div class="area-cadastro">

            <!-- <form action="" method="POST" onsubmit="return validarForm();"> -->
            <form action="" method="POST">

                <input type="text" placeholder="Informe o nome"
                    name="nome" id="nome"
                    value="<?= $nome ?>">

                <div class="erro">
                    <?php
                    if (isset($msgs['nome'])) {
                        echo $msgs['nome'];
                    }
                    ?>
                </div>

                <br><br>

                <select name="genero" id="genero">
                    <option value="">Selecione o gênero</option>

                    <option value="AC" <?= $genero == "AC" ? "selected" : "" ?>>
                        Ação</option>

                    <option value="AV" <?= $genero == "AV" ? "selected" : "" ?>>
                        Aventura</option>

                    <option value="BR" <?= $genero == "BR" ? "selected" : "" ?>>
                        Battle Royale</option>

                    <option value="CO" <?= $genero == "CO" ? "selected" : "" ?>>
                        Corrida</option>

                    <option value="ES" <?= $genero == "ES" ? "selected" : "" ?>>
                        Esporte</option>

                    <option value="LU" <?= $genero == "LU" ? "selected" : "" ?>>
                        Luta</option>

                    <option value="MO" <?= $genero == "MO" ? "selected" : "" ?>>
                        MOBA</option>

                    <option value="PU" <?= $genero == "PU" ? "selected" : "" ?>>
                        Puzzle</option>

                    <option value="RP" <?= $genero == "RP" ? "selected" : "" ?>>
                        RPG</option>

                    <option value="RM" <?= $genero == "RM" ? "selected" : "" ?>>
                        Ritmo/Musical</option>

                    <option value="SA" <?= $genero == "SA" ? "selected" : "" ?>>
                        Sandbox</option>

                    <option value="SI" <?= $genero == "SI" ? "selected" : "" ?>>
                        Simulação</option>

                    <option value="SO" <?= $genero == "SO" ? "selected" : "" ?>>
                        Sobrevivência</option>

                    <option value="TE" <?= $genero == "TE" ? "selected" : "" ?>>
                        Terror</option>

                    <option value="TI" <?= $genero == "TI" ? "selected" : "" ?>>
                        Tiro</option>




                </select>

                <div class="erro">
                    <?php
                    if (isset($msgs['genero'])) {
                        echo $msgs['genero'];
                    }
                    ?>
                </div>

                <br><br>

                <input type="number" name="preco" id="preco"
                    placeholder="Informe o preço"
                    step="0.01"
                    value="<?= $preco ?>">

                <div class="erro">
                    <?php
                    if (isset($msgs['preco'])) {
                        echo $msgs['preco'];
                    }
                    ?>
                </div>

                <br><br>

                <input type="text" placeholder="Informe a desenvolvedora"
                    name="dev" id="dev"
                    value="<?= $dev ?>">

                <div class="erro">
                    <?php
                    if (isset($msgs['dev'])) {
                        echo $msgs['dev'];
                    }
                    ?>
                </div>

                <br><br>

                <select name="classi" id="classi">

                    <option value="">Selecione a classificação</option>

                    <option value="Li" <?= $classi == "Li" ? "selected" : "" ?>>
                        Livre
                    </option>

                    <option value="3" <?= $classi == "3" ? "selected" : "" ?>>
                        3
                    </option>

                    <option value="6" <?= $classi == "6" ? "selected" : "" ?>>
                        6
                    </option>

                    <option value="10" <?= $classi == "10" ? "selected" : "" ?>>
                        10
                    </option>

                    <option value="12" <?= $classi == "12" ? "selected" : "" ?>>
                        12
                    </option>

                    <option value="14" <?= $classi == "14" ? "selected" : "" ?>>
                        14
                    </option>

                    <option value="16" <?= $classi == "16" ? "selected" : "" ?>>
                        16
                    </option>

                    <option value="18" <?= $classi == "18" ? "selected" : "" ?>>
                        18
                    </option>

                </select>

                <div class="erro">
                    <?php
                    if (isset($msgs['classi'])) {
                        echo $msgs['classi'];
                    }
                    ?>
                </div>


                <br>


                <span
                    title="Li = Livre para todas as idades.
3 = Conteúdo muito leve.
6 = Violência fantasiosa muito leve ou temas de medo leves.
10 = Violência leve, sustos leves.
12 = Violência moderada, linguagem imprópria ocasional.
14 = Violência mais frequente, referências a drogas ou sexualidade.
16 = Violência intensa, drogas e conteúdo sexual.
18 = Violência extrema, sexo explícito, tortura e mutilação."
                    style="cursor: help; font-weight: bold;">
                    ⓘ
                </span>
                <br><br>

                <input type="text" placeholder="Informe a URL da imagem"
                    name="img" id="img"
                    value="<?= $img ?>">

                <div class="erro">
                    <?php
                    if (isset($msgs['img'])) {
                        echo $msgs['img'];
                    }
                    ?>
                </div>

                <br><br>

                <button type="submit">Cadastrar</button>

            </form>


            <div class="preview">

                <img id="previewImg"
                    src="https://placehold.co/600x300?text=Imagem+do+Jogo">

                <h2 id="previewNome">
                    Nome do Jogo
                </h2>

                <p id="previewGenero">
                    Gênero
                </p>

                <p id="previewDev">
                    Desenvolvedora
                </p>

                <p id="previewClassi">
                    Classificação
                </p>

                <div id="previewPreco" class="previewPreco">
                    R$ 0,00
                </div>

            </div>

        </div>

    </div>

    <?php include("menu&roda/rodape.php"); ?>


    <script>
        document.getElementById("nome")
            .addEventListener("input", function() {

                document.getElementById("previewNome")
                    .innerText = this.value || "Nome do Jogo";

            });

        document.getElementById("dev")
            .addEventListener("input", function() {

                document.getElementById("previewDev")
                    .innerText = this.value || "Desenvolvedora";

            });

        document.getElementById("preco")
            .addEventListener("input", function() {

                let valor = parseFloat(this.value);

                if (isNaN(valor)) {
                    valor = 0;
                }

                document.getElementById("previewPreco")
                    .innerText =
                    "R$ " + valor.toFixed(2).replace(".", ",");

            });

        document.getElementById("classi")
            .addEventListener("change", function() {

                document.getElementById("previewClassi")
                    .innerText =
                    "Classificação: " + this.value;

            });

        document.getElementById("genero")
            .addEventListener("change", function() {

                document.getElementById("previewGenero")
                    .innerText =
                    this.options[this.selectedIndex].text;

            });

        document.getElementById("img")
            .addEventListener("input", function() {

                if (this.value.trim() != "") {

                    document.getElementById("previewImg")
                        .src = this.value;

                }

            });
    </script>




</body>

</html>


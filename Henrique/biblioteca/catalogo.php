

<?php

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();

$sql = "SELECT * FROM jogos";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$jogos = $stmt->fetchAll();

$sql = "SELECT * FROM jogos ORDER BY RAND() LIMIT 6";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$carrossel = $stmt->fetchAll();

function generoNome($sigla)
{
    switch ($sigla) {
        case "AC":
            return "Ação";
        case "AV":
            return "Aventura";
        case "BR":
            return "Battle Royale";
        case "CO":
            return "Corrida";
        case "ES":
            return "Esporte";
        case "LU":
            return "Luta";
        case "MO":
            return "MOBA";
        case "PU":
            return "Puzzle";
        case "RP":
            return "RPG";
        case "RM":
            return "Ritmo/Musical";
        case "SA":
            return "Sandbox";
        case "SI":
            return "Simulação";
        case "SO":
            return "Sobrevivência";
        case "TE":
            return "Terror";
        case "TI":
            return "Tiro";
        default:
            return "Outro";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steamy</title>

    <link rel="icon" type="image/png" href="https://raw.githubusercontent.com/NestorRauber/imgDeSites/refs/heads/main/0.png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background:
                radial-gradient(circle at top, #2a475e 0%, #1b2838 35%, #0f1923 100%);
            color: white;
            min-height: 100vh;
        }

        .topo {
            background: #171a21;
            border-bottom: 1px solid rgba(255, 255, 255, .05);
            padding: 20px 5%;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 1px;
        }

        .logo-img {
            width: 100px;
        }

        .logo {
            font-size: 38px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .logo span {
            color: #66c0f4;
        }

        .btn-cadastro {
            margin-left: auto;
            background: linear-gradient(90deg, #66c0f4, #1a9fff);
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: .3s;
        }

        .btn-cadastro:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(102, 192, 244, .5);
        }

        .btn-excluir-menu {
            margin-left: 10px;
            background: #d9534f;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: .3s;
        }

        .btn-excluir-menu:hover {
            background: #c9302c;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        .titulo {
            margin: 40px 0 20px;
            font-size: 28px;
            letter-spacing: 1px;
        }

        /* CARROSSEL */

        .carousel {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            background: #16202d;
            box-shadow:
                0 15px 40px rgba(0, 0, 0, .5);
        }

        .slide {
            display: none;
            grid-template-columns: 70% 30%;
            min-height: 420px;
            animation: fade .8s ease;
        }

        .slide.active {
            display: grid;
        }

        @keyframes fade {
            from {
                opacity: 0;
                transform: scale(.98);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .slide img {
            width: 100%;
            height: 420px;
            object-fit: cover;
        }

        .slide-info {
            background: linear-gradient(180deg,
                    #2a475e,
                    #1b2838);

            padding: 30px;
        }

        .slide-info h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .slide-info p {
            margin-bottom: 12px;
            color: #c7d5e0;
        }

        .slide-preco {
            margin-top: 30px;
            font-size: 34px;
            font-weight: bold;
            color: #66c0f4;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 55px;
            height: 55px;
            border: none;
            cursor: pointer;
            color: white;
            font-size: 30px;
            border-radius: 50%;
            backdrop-filter: blur(10px);
            background: rgba(0, 0, 0, .4);
            transition: .3s;
        }

        .carousel-btn:hover {
            background: #66c0f4;
        }

        .prev {
            left: 15px;
        }

        .next {
            right: 15px;
        }

        /* CATÁLOGO */

        .container {
            width: 80%;
            max-width: 1000px;
            margin: auto;
        }

        .jogo {
            display: flex;
            align-items: center;
            background: linear-gradient(to right, #1b2838, #16202d);
            margin-top: 2px;
            padding: 0;
            height: 98px;
            border-radius: 0;
            transition: .15s;
        }

        .jogo:hover {
            background: linear-gradient(to right, #2a475e, #1b2838);
        }

        .jogo img {
            width: 230px;
            height: 98px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .info {
            flex: 1;
            margin-left: 15px;
        }

        .nome {
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 6px;
        }

        .texto {
            margin-top: 2px;
            color: #8f98a0;
            font-size: 13px;
        }

        .preco {
            margin-right: 15px;
            background: #0f1923;
            padding: 8px 12px;
            min-width: 110px;
            text-align: right;
            color: white;
            font-size: 16px;
            font-weight: normal;
        }

        @media(max-width:900px) {

            .slide {
                grid-template-columns: 1fr;
            }

            .slide img {
                height: 260px;
            }
        }

        .indicadores {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #777;
            cursor: pointer;
            transition: .3s;
        }

        .dot.active {
            background: #66c0f4;
            transform: scale(1.3);
        }

        .rodape {
            margin-top: 60px;
            background: #171a21;
            border-top: 1px solid rgba(255, 255, 255, .08);
            padding: 30px 5%;
            text-align: center;
        }

        .rodape-logo {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .rodape-logo span {
            color: #66c0f4;
        }

        .rodape-texto {
            color: #8f98a0;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .rodape-links {
            margin-top: 15px;
        }

        .rodape-links a {
            color: #66c0f4;
            text-decoration: none;
            margin: 0 10px;
        }

        .rodape-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include("menu&roda/menu.php"); ?>

    <div class="container">

        <h2 class="titulo">DESTAQUES E RECOMENDADOS</h2>

        <div class="carousel">

            <?php
            $primeiro = true;
            foreach ($carrossel as $j):
            ?>

                <div class="slide <?= $primeiro ? 'active' : '' ?>">

                    <img src="<?= $j['img'] ?>">

                    <div class="slide-info">

                        <h2><?= $j['nome'] ?></h2>

                        <p>
                            <strong>Gênero:</strong>
                            <?= generoNome($j['genero']) ?>
                        </p>

                        <p>
                            <strong>Classificação:</strong>
                            <?= $j['classi'] == 'Li' ? 'Livre' : $j['classi'] ?>
                        </p>

                        <p>
                            Desenvolvido por <?= $j['dev'] ?>
                        </p>

                        <div class="slide-preco">
                            R$ <?= number_format($j['preco'], 2, ",", ".") ?>
                        </div>

                    </div>

                </div>

            <?php
                $primeiro = false;
            endforeach;
            ?>

            <div class="indicadores"></div>


            <button class="carousel-btn prev" onclick="anterior()">
                ❮
            </button>

            <button class="carousel-btn next" onclick="proximo()">
                ❯
            </button>

        </div>

        <h2 class="titulo">CATÁLOGO DE JOGOS</h2>

        <div class="catalogo">

            <?php foreach ($jogos as $j): ?>

                <div class="jogo">

                    <img src="<?= $j['img'] ?>" alt="<?= $j['nome'] ?>">

                    <div class="info">

                        <div class="nome">
                            <?= $j['nome'] ?>
                        </div>

                        <div class="texto">
                            <?= generoNome($j['genero']) ?>
                        </div>

                        <div class="texto">
                            <?= $j['dev'] ?>
                        </div>

                        <div class="texto">
                            <?= "Classificação: " . ($j['classi'] == "Li" ? "Livre" : $j['classi']) ?>
                        </div>

                    </div>

                    <div class="preco">
                        R$ <?= number_format($j['preco'], 2, ",", ".") ?>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <script>
        let slideAtual = 0;

        const slides = document.querySelectorAll(".slide");

        const indicadores =
            document.querySelector(".indicadores");

        slides.forEach((_, i) => {

            const dot =
                document.createElement("div");

            dot.classList.add("dot");

            if (i === 0) {
                dot.classList.add("active");
            }

            dot.onclick = () => {

                slideAtual = i;

                mostrarSlide(i);
            };

            indicadores.appendChild(dot);
        });

        function mostrarSlide(indice) {

            slides.forEach(slide => {
                slide.classList.remove("active");
            });

            document
                .querySelectorAll(".dot")
                .forEach(dot => {
                    dot.classList.remove("active");
                });

            slides[indice].classList.add("active");

            document
                .querySelectorAll(".dot")[indice]
                .classList.add("active");
        }


        function proximo() {

            slideAtual++;

            if (slideAtual >= slides.length) {
                slideAtual = 0;
            }

            mostrarSlide(slideAtual);
        }

        function anterior() {

            slideAtual--;

            if (slideAtual < 0) {
                slideAtual = slides.length - 1;
            }

            mostrarSlide(slideAtual);
        }

        setInterval(proximo, 5000);
    </script>

    <?php include("menu&roda/rodape.php"); ?>

</body>

</html>


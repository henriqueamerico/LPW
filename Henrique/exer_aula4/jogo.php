<?php
require_once("modelo/Pokemon.php");

// Criar os objetos
    $pokemon1 = new Pokemon();
    $pokemon1->setNome("Squirtle");
    $pokemon1->setImagem("https://img.pokemondb.net/artwork/avif/squirtle.avif");

    $pokemon2 = new Pokemon();
    $pokemon2->setNome("Garchomp");
    $pokemon2->setImagem("https://www.serebii.net/swordshield/pokemon/445.png");

    $pokemon3 = new Pokemon();
    $pokemon3->setNome("Gengar");
    $pokemon3->setImagem("https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/094.png");

    echo '<img src="' . $pokemon1->getImagem() . '" alt="">';
    echo '<img src="' . $pokemon2->getImagem() . '" alt="">';
    echo '<img src="' . $pokemon3->getImagem() . '" alt="">';

    $palpites = array($pokemon1, $pokemon2, $pokemon3);

// Sortear um dos objetos para ser o palpite correto

// Receber o palpite ($_GET) e mostrar se o usuário acertou ou errou
$palpites = "";
if(isset($_GET['palpite']))
    $palpites = $_GET['palpites'];

if($palpites == '1') {
   

} else if($palpites == '2') {
    
    

 } else if($palpites == '3'){
    

 }

    else { echo "Parâmetro [palpite] com valor inválido";
}


//http://localhost/LPW-main/Henrique/exer_aula4/jogo.php
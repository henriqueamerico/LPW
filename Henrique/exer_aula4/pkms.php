<?php
require_once("modelo/Pokemon.php");

//Cartas Pokemon
$pkms = array();

$Squirtle = new Pokemon("Squirtle" , "https://img.pokemondb.net/artwork/avif/squirtle.avif");
array_push($pkms , $Squirtle);

$Garchomp = new Pokemon("Garchomp", "https://www.serebii.net/swordshield/pokemon/445.png");
array_push($pkms , $Garchomp);

$Gengar = new Pokemon("Gengar" , "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/094.png");
array_push($pkms , $Gengar);

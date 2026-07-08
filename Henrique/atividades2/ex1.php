<?php

$País1 = array ("Ordem" => 1,
              "País" => "🇺🇸 Estado Unidos",
              "🏅" => 46,
              "🥈" => 37,
              "🥉" => 38,
              "🏅🥈🥉" => 121);
              
$País2 = array ("Ordem" => 2,
              "País" => "🇬🇧 Grã Bretanha",
              "🏅" => 27,
              "🥈" => 23,
              "🥉" => 17,
              "🏅🥈🥉" => 67);

$País3 = array ("Ordem" => 3,
              "País" => "🇨🇳 China",
              "🏅" => 26,
              "🥈" => 18,
              "🥉" => 26,
              "🏅🥈🥉" => 70);

$País4 = array ("Ordem" => 4,
              "País" => "🇷🇺 Rússia",
              "🏅" => 19,
              "🥈" => 17,
              "🥉" => 20,
              "🏅🥈🥉" => 56);

$País5 = array ("Ordem" => 5,
              "País" => "🇩🇪Alemanha",
              "🏅" => 17,
              "🥈" => 10,
              "🥉" => 15,
              "🏅🥈🥉" => 42);

            
$Países = array($País1, $País2, $País3, $País4, $País5);

echo "<table border=1>";

// cabeçalho
echo "<tr>";
echo "<th>Ordem</th>";
echo "<th>País</th>";
echo "<th>🏅</th>";
echo "<th>🥈</th>";
echo "<th>🥉</th>";
echo "<th>🏅🥈🥉</th>";
echo "</tr>";

// dados
foreach ($Países as $p){
    echo "<tr>";
    echo "<td>" . $p['Ordem'] . "</td>";
    echo "<td>" . $p['País'] . "</td>";
    echo "<td>" . $p['🏅'] . "</td>";
    echo "<td>" . $p['🥈'] . "</td>";
    echo "<td>" . $p['🥉'] . "</td>";
    echo "<td>" . $p['🏅🥈🥉'] . "</td>";
    echo "</tr>";
}

//http://localhost/Henrique/atividades2/ex1.php
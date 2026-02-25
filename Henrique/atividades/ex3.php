<?php

$mun1 = array ("nome" => "Foz do Iguaçu",
              "habit" => 250000,
              "area" => 500,
              "altitude" => 145,
              "estado" => "Paraná-PR");

$mun2 = array ("nome" => "Cascavel",
              "habit" => 300000,
              "area" => 420,
              "altitude" => 320,
              "estado" => "Paraná-PR");

$mun3 = array ("nome" => "Chapecó",
              "habit" => 240000,
              "area" => 120,
              "altitude" => 620,
              "estado" => "Santa Catarina-SC");

$mun4 = array ("nome" => "Blumenau",
              "habit" => 330000,
              "area" => 200,
              "altitude" => 85,
              "estado" => "Santa Catarina-SC");

$mun5 = array ("nome" => "Curitiba",
              "habit" => 1500000,
              "area" => 300,
              "altitude" => 850 ,
              "estado" => "Paraná-PR");

$municipios = array($mun1, $mun2, $mun3, $mun4, $mun5);

echo "<table border=1>";

// cabeçalho
echo "<tr>";
echo "<th>Nome</th>";
echo "<th>Habitantes</th>";
echo "<th>Área</th>";
echo "<th>Altitude</th>";
echo "<th>Estado</th>";
echo "</tr>";

// dados
foreach ($municipios as $m){
    echo "<tr>";
    echo "<td>" . $m['nome'] . "</td>";
    echo "<td>" . $m['habit'] . "</td>";
    echo "<td>" . $m['area'] . "km²</td>";
    echo "<td>" . $m['altitude'] . "m</td>";
    echo "<td>" . $m['estado'] . "</td>";
    echo "</tr>";
}
//http://localhost/Henrique/atividades/ex3.php
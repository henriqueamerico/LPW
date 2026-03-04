<?php

function linha($num, $nome, $henri){
    

    if ($henri % 2 == 0) {
        echo '<tr style="background-color: yellow">';
          echo'<td>' . $num . '</td>';
          echo'<td>' . $nome . '</td>';
        echo '</tr>';
        
    }
    else {
        echo '<tr style="background-color: lime">';
          echo'<td>' . $num . '</td>';
          echo'<td>' . $nome . '</td>';
        echo '</tr>';
        

    }
    
 } 

$j1 = ["num"=> 1, "nome"=> "Tafarel"];
$j2 = ["num"=> 2, "nome"=> "Jorginho"];
$j3 = ["num"=> 13, "nome"=> "Aldair"];
$j4 = ["num"=> 15, "nome"=> "Márcio Santos"];
$j5 = ["num"=> 6, "nome"=> "Branco"];
$j6 = ["num"=> 5, "nome"=> "Mauro Silva"];
$j7 = ["num"=> 8, "nome"=> "Dunga"];
$j8 = ["num"=> 17, "nome"=> "Mazinho"];
$j9 = ["num"=> 9, "nome"=> "Zinho"];
$j10 = ["num"=> 11, "nome"=> "Romário"];
$j11 = ["num"=> 7, "nome"=> "Bebeto"];
$selecao = [$j1, $j2, $j3, $j4, $j5, $j6, $j7, $j8, $j9,$j10,$j11];


echo'<table border = 1>';
    echo'<tr>';
        echo'<th>Número</th>';
        echo'<th>Nome</th>';
    echo'</tr>';

    foreach($selecao as $i => $s) {
        linha($s["num"],$s["nome"], $i);
    }
echo'</table>';
// http://localhost/Henrique/atividades4/ex1.php
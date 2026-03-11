<?php

echo "Parâmetros recebidos por GET: ";

echo "<br>";
echo $_GET['nome'];

echo "<br>";
$idade = $_GET['idade'];
echo "idade da pessoa:" . $idade;



//http://localhost/LPW-main/Henrique/aula3/exemplo_get.php?nome=Henrique&idade=16
<?php

// Recebimento do parâmetro tipo
$tipo = "";
if(isset($_GET['tipo']))
    $tipo = $_GET['tipo'];

if($tipo == 'A') {
    // Array
    $pessoaArray['nome'] = $_GET['nome'];
    $pessoaArray['sobrenome'] = $_GET['sobrenome'];
    $pessoaArray['idade'] = $_GET['idade'];

    echo "<span style='font-weight: bold;'>Nome completo:</span>";
        echo $pessoa["nome"] . " " . $pessoa["sobrenome"];
        echo "<br>";

        echo "<span style='font-weight: bold;'>Idade:</span>";
        echo $pessoa["idade"];


} else if ($tipo == 'C') {
    // Classe e objetos
    $pessoa = new Pessoa();
    $pessoa->setNome($_GET['nome']);
    $pessoa->setSobrenome($_GET['sobrenome']);
    $pessoa->setIdade($_GET['idade']);

    


} else {
    echo "Parâmetro [tipo] com valor inválido";
}
//http://localhost/LPW-main/Henrique/aula3/modelo/pagina.php
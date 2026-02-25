<!-- http://localhost/Henrique/atividades3/index.php -->
<?php

require_once("modelo/Presidente.php");

$egp = new Presidente();
$egp->setNumero(16);
$egp->setNome("Eurico Gaspar Dutra");
$egp->setInicio(1946);
$egp->setFim(1951);

$gv = new Presidente();
$gv->setNumero(17);
$gv->setNome("Getúlio Vargas");
$gv->setInicio(1951);
$gv->setFim(1954);

$cf = new Presidente();
$cf->setNumero(18);
$cf->setNome("Café Filho");
$cf->setInicio(1954);
$cf->setFim(1955);

$cl = new Presidente();
$cl->setNumero(19);
$cl->setNome("Carlos Luz");
$cl->setInicio(1955);
$cl->setFim(1955);

$nr = new Presidente();
$nr->setNumero(20);
$nr->setNome("Nereu Ramos");
$nr->setInicio(1955);
$nr->setFim(1956);

$jk = new Presidente();
$jk->setNumero(18);
$jk->setNome("Juscelino Kubitschek");
$jk->setInicio(1956);
$jk->setFim(1961);

$presidentes = array($egp, $gv, $cf, $cl, $nr, $jk);

echo "<table border=1>";

// cabeçalho
echo "<tr>";
echo "<th>Numero</th>";
echo "<th>Nome</th>";
echo "<th>Inicio</th>";
echo "<th>Fim</th>";


// dados
foreach ($presidentes as $pre){
    echo "<tr>";
    echo "<td>" . $p['Numero'] . "</td>";
    echo "<td>" . $p['Nome'] . "</td>";
    echo "<td>" . $p['Inicio'] . "</td>";
    echo "<td>" . $p['Fim'] . "</td>";
    echo "</tr>";
}






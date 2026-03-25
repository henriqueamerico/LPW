<?php
require_once("pkms.php");

$rand = rand(0, count($pkms) - 1);

if (!isset($_GET["palpite"])) {
    echo "<h1>Erro!</h1>";
    echo "<p>Voce precisa informar o parametro palpite na URL.</p>";
} else {
    $palpite = $_GET["palpite"];

    if ($palpite == $rand) {
        echo "<h1>Parabens! Voce acertou!</h1>";
    } else {
        echo "<h1>Errou!</h1>";
        echo "<p>O correto era: " . $pkms[$rand]->getNome() . "</p>";
    }
}


for ($i = 0; $i < count($pkms); $i++) {
    echo "<div style='display:inline-block; text-align:center; margin:120px'>";
    
    echo "<img src='" . $pkms[$i]->getLink() . "' width='250'><br>";
    
    echo "Opcao " . ($i + 1);
    
    echo "</div>";
}
?>

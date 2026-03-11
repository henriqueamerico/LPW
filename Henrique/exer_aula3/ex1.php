<?php
if(isset($_GET['num1'])&&($_GET['num2'] != "")){
$num1 = $_GET['num1'];
$num2 = $_GET['num2'];

echo "<br>";
echo "Primeiro número: " . $num1;
echo "<br>";
echo "Segundo número: " . $num2;
echo "<br>";
echo "A soma total é: " .  $num1+$num2;
echo "<br>";
echo "A subtração total é: " .  $num1-$num2;
echo "<br>";
echo "A divisão total é: " .  $num1/$num2;
echo "<br>";
echo "A multiplicação total é: " .  $num1*$num2;
echo "<br>";
echo "O resto total é: " .  $num1%$num2;

}
else{
    echo"⚠️ERRO";
    echo "<br>";
    echo "Informe os parâmetros na URL";
}






//http://localhost/LPW-main/Henrique/exer_aula3/ex1.php?num1=10&num2=5
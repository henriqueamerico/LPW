<?php
//Teste de conexão com o banco de dados
//require_once(__DIR__ . "/../../util/Connection.php");
//$conn = Connection::getConnection();
//print_r($conn);

require_once(__DIR__ . "/../../controller/AlunoController.php");
require_once(__DIR__ . "/../../controller/CursoController.php");

// buscar os alunos -> origem: base de dados
$alunoCont = new AlunoController();
$alunos = $alunoCont->listar();
//print_r($alunos);


// Inclui o cabeçalho da página
require_once(__DIR__ . "/../include/header.php");
?>

<h3>Listagem de Alunos</h3>

<a href="inserir.php">Inserir</a> 

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Idade</th>
        <th>Estrangeiro</th>
        <th>Curso</th>
        <th>Turno</th>
    </tr>
    <?php foreach ($alunos as $a) : ?>
        <tr> 
            <td><?= $a->getId(); ?></td>
            <td><?= $a->getNome() ?></td>
            <td><?= $a->getIdade() ?></td>
            <td><?= $a->getEstrangeiroDesc() ?></td>
            <td><?= $a->getCurso()->getNome() ?></td>
            <td><?= $a->getCurso()->getTurno() ?></td>
        </tr>
        <?php endforeach; ?>

</table>


<?php
//inclui o rodape da pagina
require_once(__DIR__ . "/../include/footer.php");
?>
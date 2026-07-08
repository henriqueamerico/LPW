<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/CursoController.php");


$cursoCont = new CursoController();
$cursos = $cursoCont->listar();
//print_r($cursos);




require_once(__DIR__ . "/../include/header.php");
?>

<h3>Inserir aluno</h3>

<form action="" method="POST">

    <div>
        <label for="txtNome">Nome: </label>
        <input type="text" id="txtNome" name="nome"
            placeholder="Informe o nome">
    </div>

    <div>
        <label for="txtIdade">Idade: </label>
        <input type="number" id="txtIdade" name="idade"
            placeholder="Informe a idade">
    </div>

    <div>
        <label for="selEstrangeiro">Estrangeiro: </label>
        <select name="estrangeiro" id="selEstrangeiro">
            <option value="">----Selecione----</option>
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>

    </div>

    <div>
        <label for="selCurso">Curso: </label>
        <select name="curso" id="selCurso">
            <option value="">----Selecione----</option>

            <!-- Cursos criados de forma dinamica -->
            <?php foreach ($cursos as $c) : ?>
                <option value="<?= $c->getId() ?>"><?= $c->getNome() ?></option>
            <?php endforeach; ?>

        </select>
    </div>

    <button type="submit">Gravar</button>

</form>

<a href="listar.php">Voltar</a>

<?php
require_once(__DIR__ . "/../include/footer.php");
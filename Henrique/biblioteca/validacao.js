function validarForm() {
    // 1- Pegar os valores dos inputs do formulário
    var titulo = document.getElementById('titulo').value;
    var genero = document.getElementById('genero').value;
    var autor = document.getElementById('autor').value;
    var qtdPag = document.getElementById('paginas').value;

    //alert(titulo + " - " + genero + " - " + autor + " - " + qtdPag);

    var divMsgErro = document.getElementById('msgErro');
    var erros = [];

    // 2- Validar os dados preenchidos
    if (titulo.trim() == '') {
        erros.push("Informe o título!");

    }

    if (genero.trim() == '') {
        erros.push("Informe o gênero!");
    }

    if (qtdPag.trim() == '') {
        erros.push("Informe o número de páginas!");
    }

    if (autor.trim() == '') {
        erros.push("Informe o autor!");
    }

    if (erros.length > 0) {
        divMsgErro.innerHTML = erros.join("<br>");
        divMsgErro.style.display = "block"; 
        return false;
    }

    // 3- Após validar, retorna verdadeiro para submeter o form
    return true;
} 
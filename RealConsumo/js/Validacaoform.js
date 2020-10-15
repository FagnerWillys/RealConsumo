
function ValidarCliente(formulario) {
    if (!validar(formulario)) {
        return false;
    }
    if (!checkNumber(retirarAcentos(formulario.Data.value))) {
        alert('Campo Data');
        return false;
    }
    if(!CheckInteiro(document.getElementById('Economias').value)){
        alert('O Campo Economias só é permitido numeros inteiros');
        return false;
    }
    //CHECANDO NUMERO
    if (!checkNumber(retirarAcentos(formulario.CNPJ.value))) {
        alert('Campo CNPJ');
        return false;
    }
    if (!checkNumber(retirarAcentos(formulario.CEP.value))) {
        alert('Campo CEP');
        return false;
    }
    if (!checkNumber(retirarAcentos(formulario.LANT.value))) {
        alert('Campo Leitura Anterior');
        return false;
    }
    if (!checkNumber(retirarAcentos(formulario.LATU.value))) {
        alert('Campo Leitura Atual');
        return false;
    }
    if (!checkNumber(retirarAcentos(formulario.Tarifa.value))) {
        alert('Campo Tarifa');
        return false;
    }
    if (!checkNumber(retirarAcentos(formulario.VCONTA.value))) {
        alert('Campo Valor da Conta');
        return false;
    }
    //CHECANDO MAIOR
    if (!checkMaior(retirarAcentos(formulario.LATU.value), retirarAcentos(formulario.LANT.value))) {
        alert('Leitura Anterior não Pode ser maior nem igual a Leitura Atual!');
        return false;
    }
    //CHECANDO NEGATIVO
    if (!checkNegativo(retirarAcentos(formulario.LATU.value)) || !checkNegativo(retirarAcentos(formulario.LANT.value)) ||
            !checkNegativo(retirarAcentos(formulario.Economias.value)) || !checkNegativo(retirarAcentos(formulario.Tarifa.value))
            || !checkNegativo(retirarAcentos(formulario.VCONTA.value))) {
        alert('Valores Negativos não são permitidos');
        return false;
    }
    //VALIDANDO CNPJ e EMAIL
    if (!validarCNPJ(formulario.CNPJ.value)) {
        alert("CNPJ INVALIDO");
        return false;
    }

    if (!validacaoEmail(formulario.Email)) {
        alert("EMAIL INVALIDO");
        return false;
    }
    //SE CHEGOU ATE AQUI PODE CONTINUAR
    formulario.CNPJ.value = retirarAcentos(formulario.CNPJ.value);
    formulario.CEP.value = retirarAcentos(formulario.CEP.value);
    formulario.ok.value = 'true';
    formulario.submit();

}
function ValidarIndex(formulario) {
    if (!validar(formulario)) {
        return false;
    }
    if (!checkNumber(retirarAcentos(formulario.CNPJ.value))) {
        return false;
    }
    if (!checkNumber(retirarAcentos(formulario.CEP.value))) {
        return false;
    }
    if (!validarCNPJ(formulario.CNPJ.value)) {
        alert("CNPJ INVALIDO");
        return false;
    }

    if (!validacaoEmail(formulario.Email)) {
        alert("Email INVALIDO");
        return false;
    }

    formulario.CNPJ.value = retirarAcentos(formulario.CNPJ.value);
    formulario.CEP.value = retirarAcentos(formulario.CEP.value);
    formulario.ok.value = 'true';
    formulario.submit();

}
function Validaralterarsenha(formulario) {
    if (!validar(formulario)) {
        return false;
    }

    formulario.ok.value = 'true';
    formulario.submit();

}

//====================================SUBFUNÇÕES=======================================
function CheckInteiro(valor) {
    valor = parseFloat(valor);
    if (Number.isInteger(valor)) {
        return true;
    } else {
        return false;
    }
}
function VALIDADATA(dataentrada) {
    //Aqui estou verificando se o campo data foi prrenchido
    if (dataentrada == "") {
        alert('Preencha o campo com a data de entrada');
        return false;
    }
// Verificar se o formato da data digitada está correto		
    var patternData = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
    if (!patternData.test(dataentrada)) {
        alert("Digite a data no formato Dia/Mês/Ano");
        return false;
    }
//A partir daqui quero verificar se a data é válida
}
function Confirmbutton(formulario) {
    if (formulario.escolha.value == "Limpar") {
        if (confirm('Deseja Continuar?')) {
            document.getElementById("confirm").value = "True";
            formulario.ok.value = 'true';
        } else {
            document.getElementById("confirm").value = "False";
            formulario.ok.value = 'false';
        }
    } else {
        formulario.ok.value = 'true';
    }
    formulario.submit();
}

function checkNegativo(valor) {
    if (valor >= 0) {
        return true;
    } else {
        return false;
    }
}
function checkMaior(valorMaior, valorMenor) {
    if (valorMaior > valorMenor) {
        return true;
    } else {
        return false;
    }
}
function checkNumber(valor) {
    var regra = /^[0-9]+$/;
    if (valor.match(regra)) {
        return true;
    } else {
        alert("Campo Numerico Preenchido com Letras!");
        return false;
    }
}

function retirarAcentos(campo) {
    const parsed = campo.normalize('NFD').replace(/([\u0300-\u036f]|[^0-9a-zA-Z])/g, '');
    console.log(parsed);
    return parsed;
}
function checkNumber8(NUM) {
    NUM = NUMj.replace(/[^\d]+/g, '');
    if (NUM == '')
        return false;
    if (NUM.length != 8)
        return false;
}
function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');
    if (cnpj == '')
        return false;
    if (cnpj.length != 14)
        return false;
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
        return false;
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;
    return true;
}

function validacaoEmail(field) {
    usuario = field.value.substring(0, field.value.indexOf("@"));
    dominio = field.value.substring(field.value.indexOf("@") + 1, field.value.length);
    if ((usuario.length >= 1) &&
            (dominio.length >= 3) &&
            (usuario.search("@") == -1) &&
            (dominio.search("@") == -1) &&
            (usuario.search(" ") == -1) &&
            (dominio.search(" ") == -1) &&
            (dominio.search(".") != -1) &&
            (dominio.indexOf(".") >= 1) &&
            (dominio.lastIndexOf(".") < dominio.length - 1)) {
        document.getElementById("Email").innerHTML = "E-mail válido";
        return true;
    } else {
        document.getElementById("Email").innerHTML = "<font color='red'>E-mail inválido </font>";
        return false;
    }
}


function validar(formulario) {

    for (i = 0; i <= formulario.length - 1; i++) {

        if ((formulario[i].value == "") && (formulario[i].title != "")) {
            if ((formulario[i].type != "button") && (formulario[i].type != "submit") && (formulario[i].type != "hidden")) {
                alert(formulario[i].title);
                formulario[i].focus();
                return false;
            }
        }
    }

    return true;
}

function limpar(formulario) {

    for (i = 0; i <= formulario.length - 1; i++) {

        if ((formulario[i].type != "button") && (formulario[i].type != "submit")) {
            formulario[i].value = '';
        }
    }

}

function pesquisa(pagina, valor)
{
//Fun��o que monta a URL e chama a fun��o AJAX
    url = pagina + valor;
    campo = 'estadual'
    ajax(url, campo);
}
//valida telefone
function ValidaTelefone(tel, tipo) {

    if (tipo == 1) {
        exp = /\(\d{2}\)\ \d{4}\-\d{4}/
        if (!exp.test(tel.value)) {
            alert('Numero de Telefone Invalido!');
            document.form.telefone.focus();
        }
    }
}
//valida cep
function ValidaCep(cep) {
    exp = /\d{2}\.\d{3}\-\d{3}/
    if (!exp.test(cep.value)) {
        alert('Numero de Cep Invalido!');
        document.form.cep.focus();
        return false;
    }
}



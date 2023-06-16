function mascaraMutuario(o, f) {
    v_obj = o
    v_fun = f
    setTimeout('execmascara()', 1)
}

function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}

function cpfCnpj(v) {

    //Remove tudo o que não é dígito
    v = v.replace(/\D/g, "")

    if (v.length <= 11) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d)/, "$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v = v.replace(/(\d{3})(\d)/, "$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")

    } else if (v.length > 11 & v.length == 14) { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v = v.replace(/^(\d{2})(\d)/, "$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v = v.replace(/(\d{4})(\d)/, "$1-$2")

    }

    return v

}

function Cep(v) {

    //Remove tudo o que não é dígito
    v = v.replace(/\D/g, "")

    if (v.length <= 8) {
        //Coloca um hífen entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{5})(\d{1,2})/, "$1-$2")

    }

    return v

}


// ENDEREÇO AUTOMATICO PELO CEP //
$("#cep").focusout(function () {
    $.ajax({
        url: 'https://cdn.apicep.com/file/apicep/' + $(this).val() + '.json',

        dataType: 'json',

        success: function (resposta) {
            $("#logradouro").val(resposta.address);
            $("#bairro").val(resposta.district);
            $("#cidade").val(resposta.city);
            $("#estado").val(resposta.state);

            $("#numero").focus();
        }
    });
});

// ADICIONAR SELECT //
var line = 2;
function addSelect(divName) {
    var newdiv = document.createElement('div');
    var new_PHP = "<?php include_once ('../actions/config.php'); $query = 'SELECT * FROM produtos'; $result = mysqli_query($conexao, $query) or die('Erro no Banco de Dados'); $row = mysqli_fetch_assoc($result); $total = mysqli_num_rows($result); if ($total > 0) { do { if ($row['qtde_prod'] > 0) { $cod_prod = $row['cod_prod']; $name_prod = $row['name_prod']; $und_medida = $row['und_medida']; echo '<option>'.$cod_prod.' | Nome: '.$name_prod.' | Und de medida: '.$und_medida.'</option>'; } } while ($row = mysqli_fetch_assoc($result)); } ?>";
    newdiv.innerHTML += "<div class='d-flex align-items-center justify-content-between mt-2'><select class='form-select' name='produto_serv" + line + "' id='produto_serv" + line + "'><option selected disabled>Selecione o produto...</option>" + new_PHP + "</select><input class='w-50 form-control' id='qtd_uso" + line + "' name='qtd_uso" + line + "' placeholder='Quantidade' required/></div>";
    document.getElementById(divName).appendChild(newdiv);
    line++;
}

addInput('lines');






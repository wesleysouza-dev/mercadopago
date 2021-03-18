
function loadCep()
{
    var zip_code = $('#cep').val().replace(/\D/g, '');

    if (zip_code != "") {

        var validacep = /^[0-9]{8}$/;

        if(validacep.test(zip_code)) {
            $("#bairro").val("...");
            $("#endereco").val("...");
           // $("#estado").val("...");
            $("#cidade").val("...");
         

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ zip_code +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {

                    $("#endereco").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#estado").find('option[value="'+dados.uf+'"]').prop('selected',true);

                } 
                else {
                    //CEP pesquisado nao foi encontrado.
                    limpa_formulario_cep();
                    alert('CEP não encontrado, digite manualmente por favor')
                }
            });
        } 
        else {
            
            limpa_formulario_cep();
            alert('Formato de CEP inválido')
        }
    } 
    else {
        limpa_formulario_cep();
    }
}


function limpa_formulario_cep() {
    // Limpa valores do formulario de cep.
    $("#endereco").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#estado").val("");
}
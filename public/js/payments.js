
function PaymentMP(form) {
    form = $('#paymentForm').serialize();
    const ajax =
            jQuery.ajax({			
                url: '/payments',
                type: 'POST',
                data: form,
                beforeSend: function() {
                    jQuery('#paymentForm .loader-btn').html('<img src="loading.gif" width="40"/>');
                },
                
            }).done( function(data) {
                data = JSON.parse(data)

                if (data.status === 'approved') {
                    $('#paymentForm input').val('');
                    $('#installments option').remove();
                    window.location.href=url_obrigado;
                } else if(data.status == false) {
                    alert('Ops, '+data.msg)
                } else {
                    alert('Houve um erro inesperado, contate o administrador do sistema.')
                }
                jQuery('#paymentForm .loader-btn').html('');
            }).fail(function(xhr,er){
                jQuery('#paymentForm .loader-btn').html('');
                alert('Ops, Houve um problema ao cobrar, contate o administrador do sistema.')
            });

    return ajax;
}


function PaymentBoleto() {
    form = $('#form-boleto').serialize();
    const ajax =
            jQuery.ajax({			
                url: '/payments',
                type: 'POST',
                data: form,
                beforeSend: function() {
                    jQuery('#form-boleto .loader-btn').html('<img src="loading.gif" width="40"/>');
                },
                
            }).done( function(data) {
                data = JSON.parse(data)

                if (data.status === 'pending') {
                    let link = data.link_boleto
                    window.location.href=url_obrigado
                    
                    $('#form-boleto input').val('');
                } else if(data.status == false) {
                    alert('Erro ao gerar boleto!!')
                } else {
                    alert('Houve um erro inesperado, contate o administrador do sistema.')
                }
                jQuery('#form-boleto .loader-btn').html('');
            }).fail(function(xhr,er){
                alert('Houve uma falha inesperada, contate o administrador do sistema.')
            });

    return ajax;
}
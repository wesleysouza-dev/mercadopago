@extends('layouts.master')
@section('title','Pagamento com Mercadopago')
@section('content')
@push('styles')
<style>
   .form-group{
   margin: 12px 0;
   }
</style>
@endpush
<div class="container">
   <img src="{{asset('logo-mercadopago.png')}}" alt="Mercadopago" class="d-table img-fluid mx-auto my-4">
   <h1 class="text-center mt-5">Faça seu Pagamento</h1>
   <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
         <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Cartão de Crédito</button>
      </li>
      <li class="nav-item" role="presentation">
         <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Boleto</button>
      </li>
   </ul>
   <div class="tab-content py-4" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
         <!-- CARTÃO -->
         <form action="/payments" method="post" id="paymentForm">
            {!! csrf_field() !!}
            <div>
               <div class="form-group">
                  <label for="username">
                     <h6>Nome Completo</h6>
                  </label>
                  <input type="text" name="cardholderName" id="cardholderName" data-checkout="cardholderName"value="" class="form-control" required> 
               </div>
               <div class="form-group">
                  <label for="username">
                     <h6>Seu e-mail</h6>
                  </label>
                  <input type="text" name="email" value="" required class="form-control" required> 
               </div>
               <div class="row">
                  <div class="col-4 col-sm-4">
                     <label>
                        <h6>Tipo de Documento</h6>
                     </label>
                     <div class="form-group">
                        <select class="form-control"id="docType" name="docType" data-checkout="docType" type="text">
                        </select>
                     </div>
                  </div>
                  <div class="col-8 col-sm-8">
                     <label>
                        <h6>Número do Documento</h6>
                     </label>
                     <div class="form-group">
                        <input type="text" name="docNumber" value="" id="docNumber" data-checkout="docNumber" class="form-control doc">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="cardNumber">
                     <h6>Número do Cartão</h6>
                  </label>
                  <div class="input-group">
                     <input type="text" name="cardNumber" id="cardNumber" data-checkout="cardNumber" class="form-control" value="5031 4332 1540 6351" required>
                     <div class="input-group-append"> 
                        <span class="input-group-text text-muted" id="bandeira-cartao" style="height: 100%;"> 
                        </span> 
                     </div>
                     
                  </div>
                  <div class="form-text">*Apague os espaços para teste</div>
               </div>
               <div class="row">
                  <div class="col-sm-8">
                     <div class="form-group">
                        <label>
                           <span class="hidden-xs">
                              <h6>Data de Expiração</h6>
                           </span>
                        </label>
                        <div class="input-group"> 
                           <input type="number" placeholder="Mês" name="cardExpirationMonth" class="form-control" required
                              id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                              onselectstart="return false" onpaste="return false"
                              oncopy="return false" oncut="return false"
                              ondrag="return false" ondrop="return false" autocomplete=off
                              value="11"
                              > 
                           <input type="number" placeholder="Ano" name="cardExpirationYear" class="form-control" required
                              id="cardExpirationYear" data-checkout="cardExpirationYear"
                              onselectstart="return false" onpaste="return false"
                              oncopy="return false" oncut="return false"
                              ondrag="return false" ondrop="return false" autocomplete=off
                              value="25"
                              > 
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group mb-4">
                        <label data-toggle="tooltip" title="Código de segurança do seu cartão - Muitas das vezes fica no verso do cartão">
                           <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                        </label>
                        <input type="text" required class="form-control"
                           id="securityCode" data-checkout="securityCode" type="text"
                           onselectstart="return false" onpaste="return false"
                           oncopy="return false" oncut="return false"
                           ondrag="return false" ondrop="return false" autocomplete=off
                           value="123"
                           > 
                     </div>
                  </div>
                  <div class="col-6 d-nonee">
                     <div id="issuerInput" class="form-group mb-4">
                        <label for="issuer">Banco emissor</label>
                        <select id="issuer" class="form-control" name="issuer" data-checkout="issuer"></select>
                        <div class="form-text">Selecione "Outro" para teste</div>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group mb-4">
                        <label for="installments">Parcelas</label>
                        <select type="text" id="installments" class="form-control" name="installments"></select>
                     </div>
                  </div>
               </div>
               <input type="hidden" name="transactionAmount" id="transactionAmount" class="transactionAmount" value="100" />
               <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
               <input type="hidden" name="description" id="description" value="Pagamento de Teste - WS" />
               <input type="hidden" name="tipo_pagamento" class="tipo_pagamento" value="Cartão" />
               <div>
                    <div class="loader-btn text-center w-100"></div>
                    <button type="submit" class="btn btn-primary btn-block shadow-sm"> Confirmar Pagamento </button>
               </div>
               
            </div>
         </form>
      </div>
      <!-- BOLETO -->
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
         <form role="form" method="post" id="form-boleto">
            {!! csrf_field() !!}
            <div class="row">
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="username">
                        <h6>Nome</h6>
                     </label>
                     <input type="text" id="payerFirstName" name="payerFirstName" required class="form-control" value=""> 
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="">
                        <h6>Sobrenome</h6>
                     </label>
                     <input id="payerLastName" name="payerLastName" type="text" required class="form-control" value="">
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="">
                  <h6>Seu e-mail</h6>
               </label>
               <input type="email" name="email" id="payerEmail" name="payerEmail" required class="form-control" value=""> 
            </div>
            <div class="row">
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="">
                        <h6>Tipo de Documento</h6>
                     </label>
                     <select name="docType" data-checkout="docType" class="docType form-control" required>
                        <option value="CPF">CPF</option>
                        <option value="CNPJ">CNPJ</option>
                     </select>
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="">
                        <h6>Nº do Documento</h6>
                     </label>
                     <input type="text" name="docNumber" value="" data-checkout="docNumber" class="docNumber form-control doc" required>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-3">
                  <div class="form-group">
                     <label>
                        <h6>CEP</h6>
                     </label>
                     <input type="text" name="cep" id="cep" class="form-control mask-cep" value="" required>
                  </div>
               </div>
               <div class="col-3">
                  <label>
                     <h6>Número</h6>
                  </label>
                  <div class="form-group">
                     <input type="text" name="numero" id="numero" class="form-control" value="" required>
                  </div>
               </div>
               <div class="col-6">
                  <label>
                     <h6>Bairro</h6>
                  </label>
                  <div class="form-group">
                     <input type="text" name="bairro" id="bairro" class="form-control" required>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="username">
                  <h6>Endereço</h6>
               </label>
               <input type="text" name="endereco" id="endereco" required class="form-control" required> 
            </div>
            <div class="row">
               <div class="col-4">
                  <label>
                     <h6>Estado</h6>
                  </label>
                  <div class="form-group">
                     <select  name="estado" id="estado" class="form-control" required>
                        <option value="" seleted>Selecione</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espirito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                     </select>
                  </div>
               </div>
               <div class="col-8">
                  <label>
                     <h6>Cidade</h6>
                  </label>
                  <div class="form-group">
                     <input type="text" name="cidade" id="cidade" class="form-control" required>
                  </div>
               </div>
            </div>
            <input type="hidden" name="transactionAmount2" class="transactionAmount" value="50" />
            <input type="hidden" name="description" class="description" value="Teste pagamento Boleto" />
            <input type="hidden" name="tipo_pagamento" class="tipo_pagamento" value="Boleto" />
            <div class="" style="background:#fff;">
               <div class="loader-btn text-center w-100"></div>
               <button type="button" id="btn-gerar-boleto" class="btn btn-primary">Gerar Boleto</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script>
    const url_obrigado = "{{route('obrigado')}}";
    const mp_public_key = "{{ $_ENV['MP_PUBLIC_KEY'] }}"
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script src="{{asset('js/functions-mp.js')}}"></script>
<script src="{{asset('js/cep.js')}}"></script>
<script src="{{asset('js/payments.js')}}"></script>
<script>
    
   //--------------------------------------------------
   //  CEP - Preenche endereço com base no cep
   //--------------------------------------------------
   
       const inputCep = $('#cep')
   
       inputCep.on('blur', function(){
           loadCep()
       })
   
   
   //--------------------------------------------------
   //  Valida e Chama função para pagamento via boleto
   //--------------------------------------------------
   
       const btnGerarBoleto = $('#btn-gerar-boleto')
       const formBoleto = $('#form-boleto')
                   
       btnGerarBoleto.on('click', function(e){
   
           let thiss = $(this)
           error = false
   
           $(this).prop('disabled', true)
   
           $('#form-boleto input, #form-boleto select').each(function() {
               if($(this).val() == ''){
                   thiss.prop('disabled', false)
                   error = true
               }
           });
   
           error ? alert('Preencha todos os campos da aba Boleto para prosseguir.') :  PaymentBoleto();
   
       })    
</script>
@endpush
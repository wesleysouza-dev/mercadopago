@extends('layouts.master')
@section('title','Status de Pagamento')
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

            <h1 class="text-center mt-5">
            Obrigado, 
            @if( Session::has( 'link_boleto' ))
            boleto gerado :)
            @else
            pagamento aprovado :)
            @endif
            </h1>


            @if( Session::has( 'link_boleto' ))
                <a href="{{ Session::get( 'link_boleto' ) }}" target="_blank" class="btn btn-outline btn-warning mx-auto d-table">Ver boleto</a>
            @endif

            <a href="{{route('home')}}" class="btn btn-success my-5 mx-auto d-table">Voltar a Home</a>
        </div>
               
        
@endsection

@push('scripts')


<script>

</script>
@endpush
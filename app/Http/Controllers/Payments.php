<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago;
use Session;

class Payments extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        MercadoPago\SDK::setAccessToken($_ENV['MP_TOKEN']);
        $payment = new MercadoPago\Payment();

        if ($_POST['tipo_pagamento'] == 'Boleto') {

            $payment->transaction_amount = (float)$_POST['transactionAmount2'];
            $payment->description = $_POST['description'] ?? 'Teste MP Boleto';
            $payment->payment_method_id = "bolbradesco";
            $payment->payer = array(
                "email" => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
                "first_name" => $_POST['payerFirstName'],
                "last_name" => $_POST['payerLastName'],
                "identification" => array(
                    "type" => $_POST['docType'],
                    "number" => $_POST['docNumber']
                ),
                "address"=>  array(
                    "zip_code" => str_replace('-','',$_POST['cep']),
                    "street_name" => $_POST['endereco'],
                    "street_number" => $_POST['numero'],
                    "neighborhood" => $_POST['bairro'],
                    "city" => $_POST['cidade'],
                    "federal_unit" => $_POST['estado']
                )
            );
            
            $payment->save();
            $link_boleto = ($payment->transaction_details->external_resource_url);

            if ($payment->status == 'pending') {
                Session::flash('link_boleto', $link_boleto); 
            }

        } else {
        
            
            $payment->transaction_amount = (float)$_POST['transactionAmount'];
            $payment->token = $_POST['token'];
            $payment->description = $_POST['description'] ?? 'Teste';
            $payment->installments = (int)$_POST['installments'];
            $payment->payment_method_id = $_POST['paymentMethodId'];
            $payment->issuer_id = (int)$_POST['issuer'];
            $payer = new MercadoPago\Payer();
            $payer->email = $_POST['email'];
            $payer->identification = array(
                "type" => $_POST['docType'],
                "number" => $_POST['docNumber']
            );
            $payment->payer = $payer;
            $payment->save();

            if ($payment->status == 'approved') {
                Session::flash('pagamento_ok', 'Pagamento aprovado :)'); 
            }
        }
        

        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        return json_encode($response);
    }
}

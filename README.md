<p align="center"><a href="https://www.mercadopago.com.br/developers/pt/guides/online-payments/checkout-api/receiving-payment-by-card" target="_blank"><img src="https://wesleydesign.com.br/projetos/github/laravel-mercadopago.png" width="300"></a></p>


## Descrição
Realize cobrança via cartão de crédito ou boleto utilizando a API do Mercadopago.


## Pré requisitos
- Instalado composer (https://getcomposer.org/download/)
- Servidor Apache ou Nginx com PHP >7.3

- **Obs**: A Versão do Laravel utilizada é a 8.12


## Como Instalar

Após clonar o repositório, executar o comando abaixo para instalar as dependências do projeto:


```
composer install
```

## Iniciar o Servidor

Para iniciar (startar) o servidor, digite o comando abaixo em seu terminal:

```
php artisan serve
```

## Arquivo .ENV

Crie seu arquivo .env (duplique o .env.example).


## Configuração das chaves do Mercadopago

Para o funcionamento correto da cobrança via cartão e boleto, é necessário criar 2 entradas em seu arquivo .ENV. São elas:


**MP_PUBLIC_KEY=**"cole-sua-chave-publica-aqui"

**MP_TOKEN=**"cole-seu-token-aqui"


Para gerar sua chave, <a href="https://www.mercadopago.com.br/mlb/account/credentials">clique aqui</a>. 

**Atenção:** Para fins de aprendizado, gere sempre a **KEY** e o **TOKEN** de **TESTE**.

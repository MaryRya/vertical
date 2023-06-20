<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Оплата</title>
    <link rel="icon" type="image/x-icon" href="/public/images/svg/Ver.svg">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="resources/js/index.global.min.js"></script>
    <!--prime:7c6e36b0-->
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <script src="resources/js/jquery-3.6.4.min.js"></script>
    <script src="resources/js/app.js"></script>
    <link href="resources/css/app.css" rel="stylesheet">
    integrity="sha512-CABi9vrtlQz9otMo5nT0B3nCBmn5BirYvO3oCnulsEzRDekxdMEZ2rXg85Is5pdnc9HNAcUEjm/7HagpqAFa1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if (Route::currentRouteName() == 'payment')
        <script src="resources/js/app.js"></script>

    @endif
</head>
<body>
<style>
    @font-face {
        font-family: 'Anonymous Pro';
        src: url('public/files/AnonymousPro-Regular.ttf') format('truetype');
    }

    .tmg{
        margin:100px auto;
        border-width:2px;
        border-style:solid;
        border-color:black;
        border-radius: 10% 5%;
        padding: 15px;
        width: 100%;
        height: 100%;
        border-bottom-width: thick
        font-size: 10px !important;
    }
    .tmg_ps_paysys_desc{
        padding-left: 20px;
        font-size:20px !important;
    }
    .tmg h3{
        font-size:20px;
        text-align: center;
        font-weight: bold;

    }
    .tmg_ps_paysys tmg_ps_type_testgw_master{
        margin-top:10px;
    }


    .tmg #tmg_ps_body .tmg_ps_paysys_desc h3{
        margin-top: none !important;
    }
    .tmg p{
        font-size:15px !important;
        text-align: none;

    }
    .tmg #tmg_ps_product{
        font-size:15px !important;
        color:black !important;
        padding-top:20px;
        width:200px;
    }
    .tmg #tmg_ps_product a:link{
        color:black !important;
    }


</style>
<div class="" style="min-height: 500px;">
    <?php

    echo file_get_contents("https://verticalgo.server.paykeeper.ru/order/inline/",FALSE, $context);
    # Вместо demo.paykeeper.ru нужно указать адрес вашего сервера paykeeper
    ?>
</div>









</body>


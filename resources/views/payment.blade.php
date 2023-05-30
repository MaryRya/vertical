<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/images/svg/Ver.svg">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="{{ Vite::asset('resources/js/index.global.min.js') }}"></script>
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <script src="{{ Vite::asset('resources/js/jquery-3.6.4.min.js') }}"></script>
    @vite([ 'resources/css/app.css', 'resources/js/app.js'])
</head>

<div class=" xl:mx-52 mx-20 " style="min-height: 600px;">
    <div class=" mx-20 mt-5 "style="min-height: 60px; width:800px">
        <img src="images/tin.png" class="ml-10 h-16 "/>
    </div>
    <div class="flex">
    <div class=" ml-20 mb-10 border-gray-200 border-2" style="min-height: 600px; width:900px">
        <div class="flex flex-wrap items-center justify-between h-[52px] ml-3 mt-5">
            <h3 class=" text-5xl  font-serif text-gray-900 ">Оплата: </h3>
            <div class="flex w-[130px] text-gray-400">
                <img class="w-5 h-5 mt-1 mr-2 mx-auto" src="/images/svg/lock.svg">
                <p class="text-md text-xs"> Безопасное соединение</p>
            </div>
        </div>
    </div>
    <div class=" mb-10 " style="min-height: 600px; width:350px">
        <div class=" ml-5 mt-80 " style="min-height: 280px; width:280px">
            <div class="mt-10 text-gray-400">
                <p class="text-xs"> АО "Тинькофф Банк" не передает магазинам платежные данные, в том числе данные карты.</p>
                <img src="images/tin.png" class="my-3 h-16 "/>
                <p class="text-xs"> Сервис предоставлен АО "Тинькофф Банк".</p>
            </div>
        </div>
    </div>
    </div>
</div>


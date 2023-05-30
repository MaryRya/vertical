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
    @if (Route::currentRouteName() == 'payment')
        @vite([ 'resources/css/app.css'])

    @endif
</head>
    <body>
    <style>
        @font-face {
            font-family: 'Anonymous Pro';
            src: url('public/files/AnonymousPro-Regular.ttf') format('truetype');
        }
        .content1 {
            padding: 40px;
            min-width: 700px;
            margin: 0;
            font-size: 30px;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-smoothing: antialiased;
            -moz-font-smoothing: antialiased;
            -webkit-font-smoothing: antialiased;
            -webkit-font-smoothing: subpixel-antialiased;
        }
        * {
            box-sizing: border-box;
            outline: none;
        }
        #cards {
            width: 19.5em;
            height: 10em;
            position: relative;
            margin: 15px auto ;
        }
        #front, #back {
            position: absolute;
            width: 14.5em;
            height: 9em;
            border-radius: 0.5em;
        }
        #front {
            top: 0;
            left: 0;
            background: #ddd;
            z-index: 100;
        }
        #number {
            width: 100%;
            margin-bottom: 0.3em;
        }
        #front-fields {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1em;
        }
        #bank-link {
            position: absolute;
            top: 1em;
            right: 1em;
            width: 320px;
            height: 60px;
            display: block;
            position: relative;
            left: 1em;
            background-size: contain;
            background-position: top left;
            background-repeat: no-repeat;
        }
        #brand-logo {
            position: absolute;
            bottom: 1em;
            right: 1em;
            text-align: right;
            height: 1.6em;
        }
        #back {
            bottom: 0;
            right: 0;
            background: #bbb;
            padding-top: 1em;
            padding-right: 1em;
            padding-left: 10.5em;
        }
        #code {
            width: 100%;
        }
        .field {
            padding: 0.3em 0.5em;
            border: none;
            font-family: 'Anonymous Pro', monospace;
            font-size: 0.9em;
            text-indent: 0.1em;
        }
        .expired {
            float: left;
            width: 3em;
            margin-right: 0.5em;
            margin-top: 0.3em;
        }
        .label {
            font-size: 0.5em;
            display: block;
            margin-top: 0.5em;
        }
        #examples {
            list-style: none;
            padding: 0;
        }
        .example {
            font-size: 0.5em;
            white-space: nowrap;
            display: inline-block;
            margin-right: 1.5em;
            margin-top: 0.3em;
        }
        .example-link {
            text-decoration: none;
            color: #07c;
            border-bottom: 1px dashed #07c;
        }
        .example-link:hover, .example-link:active {
            color: #c00;
            border-color: #c00;
        }
        .block {
            margin: 1em 0 0;
        }
        .block:first-child {
            margin: 0;
        }
        .block h2 {
            margin: 0 0 0.3em 0;
            font-size: 0.7em;
        }
        ul {
            margin: 0;
        }
        #validation {
            font-size: 0.5em;
        }
        #validation li {
            margin-bottom: 10px;
        }
        #validation li.valid {
            color: green;
        }
        #validation li.invalid {
            color: red;
        }
        #instance {
            font-size: 0.5em;
            line-height: 1.5em;
        }
    </style>
    <div class=" xl:mx-52 mx-20 " style="min-height: 500px;">
        <div class=" mx-20 mt-5 "style="min-height: 60px; width:800px">
            <img src="images/tin.png" class="ml-10 h-16 "/>
        </div>
        <div class="flex">
            <div class=" ml-20 mb-20 border-gray-300 border-2" style="min-height: 300px; width:900px">
                <div class="flex flex-wrap items-center justify-between h-[52px] ml-3 mt-5">
                    <h3 class=" text-2xl ml-10 font-serif text-gray-900 ">Оплата:  {{$_GET["price"]}} руб.</h3>
                    <div class="flex w-[130px] text-gray-400">
                        <img class="w-5 h-5 mt-1 mr-2 mx-auto" src="/images/svg/lock.svg">
                        <p class="text-md text-xs"> Безопасное соединение</p>
                    </div>
                    <div class="content1" style="text-align: center">
                        <div id="cards">
                            <div id="front">
                                <a target="_blank" href="#" id="bank-link"></a>
                                <img src="" alt="" id="brand-logo">
                                <div id="front-fields">
                                    <label class="label mb-3">Номер карты</label>
                                    <input class="field " id="number" type="text" placeholder="0000 0000 0000 0000">
                                    <input class="field expired" id="mm" type="text" placeholder="MM">
                                    <input class="field expired" id="yy" type="text" placeholder="YY">
                                </div>
                            </div>
                            <div id="back">
                                <input class="field" id="code" type="password" placeholder="">
                                <label id="code-label" class="label">Код безопасности</label>
                            </div>
                        </div>
                        <form action="{{route('payment')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_record" value="<?= $_GET['id_record']?>">
                            <button class="text-white bg-primary-800 hover:bg-indigo-800 font-medium  text-sm px-4 py-2.5 text-center inline-flex items-center">Оплатить</button>
                        </form>


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

    <script src="{{ Vite::asset('public/dist/card-info.js') }}"></script>
    <script src="{{ Vite::asset('public/files/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ Vite::asset('public/files/jquery.mask.min.js') }}"></script>


    <script>
        CardInfo.setDefaultOptions({
            banksLogosPath: '../dist/banks-logos/',
            brandsLogosPath: '../dist/brands-logos/'
        })

        $(function() {
            var $front = $('#front')
            var $bankLink = $('#bank-link')
            var $brandLogo = $('#brand-logo')
            var $number = $('#number')
            var $code = $('#code')
            var $random = $('#random')
            var $instance = $('#instance')
            var sendedPrefix = window.location.search.substr(1)

            $number.on('keyup change paste', function () {
                var cardInfo = new CardInfo($number.val())
                if (cardInfo.bankUrl) {
                    $bankLink
                        .attr('href', cardInfo.bankUrl)
                        .css('backgroundImage', 'url("' + cardInfo.bankLogo + '")')
                        .show()
                } else {
                    $bankLink.hide()
                }
                $front
                    .css('background', cardInfo.backgroundGradient)
                    .css('color', cardInfo.textColor)
                $code.attr('placeholder', cardInfo.codeName ? cardInfo.codeName : '')
                $number.mask(cardInfo.numberMask)
                if (cardInfo.brandLogo) {
                    $brandLogo
                        .attr('src', cardInfo.brandLogo)
                        .attr('alt', cardInfo.brandName)
                        .show()
                } else {
                    $brandLogo.hide()
                }
                $instance.html(JSON.stringify(cardInfo, null, 2))
            }).trigger('keyup')

            $random.on('click', function (e) {
                e.preventDefault()
                var aliases = Object.keys(CardInfo.banks)
                var alias = aliases[Math.floor(Math.random() * aliases.length)];
                var prefixes = Object.entries(CardInfo._prefixes)
                for (var i = prefixes.length; i; i--) {
                    var j = Math.floor(Math.random() * i)
                    var x = prefixes[i - 1]
                    prefixes[i - 1] = prefixes[j]
                    prefixes[j] = x
                }
                var prefix = prefixes.find(function (pair) {
                    return (pair[1] === alias)
                })[0]
                $number
                    .val($number.masked(prefix + '0000000000'))
                    .trigger('keyup')
            })
        })
    </script>
    </body>


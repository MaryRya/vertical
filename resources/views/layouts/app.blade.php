<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div id="app">
    <nav class="bg-white z-50 w-full
        w-100 h-100 px-2 md:px-4 py-2.5">
        <div class=" flex flex-wrap items-center  justify-between max-w-screen-xl mx-auto">
            <a href="/" class="flex items-center hover:text-black">
                <img src="/images/svg/Ver.svg" class="h-6 mr-3  sm:h-9" alt="Flowbite Logo" />
                <button class="self-center text-xl hover:text-black font-semibold whitespace-nowrap ">Vertical</button>
            </a>
            <div class="flex items-center md:order-2 ">
                <a class="text-sm  md:px-5 md:py-2.5 text-gray-800 rounded-lg hover:text-black mr-1 md:mr-2 ">ул. Баумана 29</a>
                @guest
                    @if (Route::has('login'))
                        <a href="/login" class="text-white bg-indigo-600 hover:bg-indigo-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 focus:outline-none "> Вход</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="/register" class="text-gray-800 hover:text-black hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-4 md:py-2 mr-1 md:mr-2 ">Регистрация</a>
                    @endif
                @else
                    <a href="/profile" class="text-gray-800  hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 ">Личный кабинет</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="  text-gray-800 mr-5  focus:ring-gray-300 font-medium rounded-lg text-sm p ">Выйти из аккаунта</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
                <button data-collapse-toggle="mega-menu-icons" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="mega-menu-icons" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>

            <div id="mega-menu-icons" class=" items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                @guest

                    <ul class="flex flex-col text-sm font-bold md:flex-row md:space-x-8 md:mt-0">
                        <li>
                            <a href="/schedule" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Расписание</a>
                        </li>
                        <li>
                            <a href="/#team" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Команда</a>
                        </li>
                        <li>
                            <a href="/#reviews" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Отзывы</a>
                        </li>
                        <li>
                            <a href="/#footer" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Контакты</a>
                        </li>
                        <li>
                            <a href="#" data-modal-toggle="ModalChat" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">Чат</a>
                        </li>
                        <div id="ModalChat" tabindex="-1" aria-hidden="true"
                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <!-- Modal content -->
                                <div class="relative p-4 text-center bg-white rounded-lg shadow  sm:p-5">
                                    <button>
                                        <img class="w-7 h-7 absolute top-2.5 right-2.5 rounded-lg text-sm p-1.5 ml-auto"
                                             src="/images/svg/close.svg" data-modal-toggle="ModalChat">
                                    </button>
                                    <label for="terms" class="px-2"> Чтобы задать вопрос необходимо<a
                                            class="font-medium text-primary-600 hover:underline" href="/register">
                                            зарегистрироваться</a> или <a class="font-medium text-primary-600 hover:underline" href="/login" target="_blank">войти</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </ul>

                @endguest
            </div>
        </div>
    </nav>
</div>
<main class="py-4">
    @yield('content')
</main>

</body>
</html>

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
<header>
    <div>
        <nav class="bg-[#e0e0f5] w-full
        w-100 h-100 px-2 md:px-4 py-2.5">
            <div class=" flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
                <a href="/" class="flex items-center">
                    <img src="/images/svg/Ver.svg" class="h-6 mr-3 sm:h-9" alt="Vertical Logo" />
                    <button class="self-center  text-xl font-semibold">Vertical</button>
                </a>
                <div class="flex items-center md:order-2 ">
                    <p class="sm:text-sm text-xs md:px-5 md:py-2.5 text-gray-800 rounded-lg  mr-1 md:mr-2 ">ул. Баумана 29</p>
                    @guest
                        @if (Route::has('login'))
                            <div class="">
                            <a href="/login" class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg md:text-sm text-xs px-4 py-2 md:px-6 md:py-2 mr-1 md:mr-2 focus:outline-none ml-4"> Вход</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="/register" class="text-gray-800  focus:ring-4 focus:ring-gray-300 font-medium rounded-lg sm:text-sm text-xs px-4 py-2 md:px-5 px-1 md:py-2.5 mr-1 md:mr-2">Регистрация</a>
                            </div>
                        @endif
                    @else
                        <a href="/profile?date=3" class="text-gray-800 hover:bg-indigo-500 hover:text-white focus:ring-4 focus:ring-gray-300 font-medium rounded-lg sm:text-sm text-xs px-1 py-1 md:px-5 px-1 ml-5 md:py-2.5 mr-1 md:mr-2 ">Личный кабинет</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class=" text-gray-800 ml-6 md:mr-5 mx-2 focus:ring-gray-300 font-medium rounded-lg sm:text-sm text-xs ">Выход</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                    <button data-collapse-toggle="mega-menu-icons" type="button" class="inline-flex ml-5 items-center  text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="mega-menu-icons" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg aria-hidden="true" class="w-6 h-6 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>

                <div id="mega-menu-icons" class=" items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                    <ul class="flex flex-col text-sm font-bold md:flex-row md:space-x-8 md:mt-0">
                        @guest
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
                                                зарегистрироваться</a> или <a class="font-medium text-primary-600 hover:underline" href="/login" >войти</a>
                                        </label>
                                    </div>
                                </div>
                            </div>


                        @else
                            @if (Auth::user()->id_role == 2)

                                <li>
                                    <a href="/#reviews" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Отзывы</a>
                                </li>
                                <li>
                                    <a href="/adminIndex" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Админ панель</a>
                                </li>

                            @endif
                            @if (Auth::user()->id_role == 2 || Auth::user()->id_role == 3)
                                <li>
                                    <a href="/schedule" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Расписание</a>
                                </li>

                            @else
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
                                    <a href="/chat" class="flex block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">Чат
                                        <div class=" ml-1 w-4 text-center h-3 rounded-full" style="font-size: 11px; line-height: 12px; color: indigo">
                                            {{ ($count != 0) ? "$count" : '' }}
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>
    </div>
</header>
@yield('content')

<footer id="footer" class="p-4  bg-[#e0e0f5] sm:p-6 ">
    <div class="mx-auto max-w-screen-xl">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="/" class="flex  mb-2 sm:mb-0">
                    <img src="/images/svg/Ver.svg" class="h-6 mr-3 sm:h-9" alt="Vertical Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap ">Vertical</span>
                </a>
            </div>
                <div class="grid grid-cols-2 gap-3 sm:gap-8 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-4 md:text-sm text-xs font-bold text-gray-900 uppercase">Эл. почта</h2>
                        <ul class="text-gray-600 ">
                            <li class="mb-4">
                                <a class=" hover:underline"> vertical@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-4 md:text-sm text-xs font-bold text-gray-900 uppercase ">Адрес</h2>
                        <ul class="text-gray-600 ">
                            <li class="mb-4">
                                <a class=" hover:underline">г. Тюмень</a> <br>
                                <a class=" hover:underline">ул. Баумана 29</a>
                            </li>
                        </ul>
                    </div>
                <div>
                    <h2 class="mb-4 md:text-sm text-xs font-bold text-gray-900 uppercase ">Телефоны</h2>
                    <ul class="text-gray-600  text-sm">
                        <li class="mb-4">
                            <a class=" hover:underline ">+7(3452)61-07-50</a>
                        </li>
                        <li>
                            <a class="hover:underline">+7 932 351 0750</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sm:flex flex justify-end md:justify-start">
            <span class="text-sm text-gray-500 sm:text-center ">© 2023 Vertical</span>
        </div>
    </div>
</footer>
</html>

@extends('main')
@section('title', 'Регистрация')
@section('content')
    <div class="flex  flex-col bg-indigo-50 items-center px-6 mx-auto py-10">
            <div class="w-full bg-white rounded-lg shadow-md border border-gray-200 md:mt-0 sm:max-w-md xl:p-0 ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Создайте аккаунт
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Имя Фамилия</label>
                            <input id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg  focus:border-indigo-600 block w-full p-2.5 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Иван Иванов">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                            <div class="mt-2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Почта</label>
                                <input id="email" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-indigo-600 block w-full p-2.5 @error('email') is-invalid @enderror"
                                       placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="mt-2">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Телефон</label>
                            <input id="phone" type="tel" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg  focus:border-indigo-600 block w-full p-2.5" value="{{ old('phone') }}" placeholder="89925555555" name="phone" required autocomplete="new-phone">
                        </div>
                        <div class="mt-2">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Пароль</label>
                                <input id="password" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-indigo-600  block w-full p-2.5 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="mt-2">
                            <label for="password-confirm" class="block mb-2 text-sm font-medium text-gray-900">Повторите пароль</label>
                                <input id="password-confirm" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg  block w-full p-2.5" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                        </div>
                        <div class="flex items-start">
                            <input id="terms" aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required>
                            <label for="terms" class="px-2 text-gray-500">Я согласен с <a class="font-medium text-primary-600 hover:underline" href="/agreement" target="_blank">Политикой конфиденциальности</a></label>
                        </div>
                        <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center d">Зарегистрироваться</button>
                        <p class="text-sm font-light text-gray-500 ">
                            Есть аккаунт? <a href="/login" class="font-medium text-primary-600 hover:underline">Войдите</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
@endsection



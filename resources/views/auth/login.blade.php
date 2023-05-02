@extends('main')
@section('content')
        <div class=" h-screen flex flex-col items-center px-6 bg-indigo-50 mx-auto py-10">
            <div class="w-full bg-white rounded-lg shadow-md  border border-gray-200 md:mt-0 sm:max-w-md  ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        Войдите в аккаунт
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Электронная почта</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  @error('email') is-invalid @enderror" placeholder="name@example.com"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Пароль</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 @error('password') is-invalid @enderror" placeholder="••••••••" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Войти</button>
                        <div class="flex justify-between ">
                        <p class="text-sm font-light text-gray-500">
                            Нет аккаунта? <a href="/register" class="font-medium text-primary-600 hover:underline">Создайте его</a>
                        </p>
                        <div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link text-sm font-medium text-primary-600 hover:underline" href="{{ route('password.request') }}">
                                Забыли пароль?
                            </a>
                        @endif
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

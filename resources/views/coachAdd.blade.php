@extends('main')
@section('title', 'Добавление тренера')
@section('content')
    @if (Auth::user()->id_role == 2)

        <div class="w-full bg-[#f9f9fa]
        w-100 h-100 px-2 xl:px-72 md:px-20 py-10">
            <div class="space-y-12 ">
                <div class=" pb-12">
                    <a href="/coachTable" type="button" class=" mb-2 sm:text-sm text-xs font-semibold leading-6 text-gray-600 hover:text-black">Вернуться назад</a>
                    <form action="{{ route('coachAddAction') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <h1 class="text-xl text-center font-semibold p-3 leading-tight tracking-tight text-gray-900">
                                Регистрация тренера
                            </h1>
                            <div class="card-body mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Имя Фамилия</label>
                                        <input id="name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="name" value="{{ old('name') }}" required autocomplete="name"  placeholder="Иван Иванов">

                                </div>
                                <div class="sm:col-span-3">
                                    <label for="name" class=" block text-sm font-medium leading-6 text-gray-900">Должность</label>
                                        <input readonly id="name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"  placeholder="тренер" value="тренер">
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Электронный адрес</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email') is-invalid @enderror" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Телефон</label>
                                        <input required id="phone" type="number" class=" w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6  "  name="phone" autocomplete="new-phone" placeholder="89925555555" value="{{ old('phone') }}">
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Пароль</label>
                                        <input id="password" type="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="password-confirm" class="block text-sm font-medium leading-6 text-gray-900">Повторите пароль</label>
                                        <input id="password-confirm" type="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-span-full">
                                    <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Загрузить
                                        изображение</label>
                                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                        <div class="text-center">
                                            <img src="/images/default.png" class="ml-auto mr-auto w-14 md:w-1/6"  id="img"/>
                                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                <label for="file-upload"
                                                       class="relative cursor-pointer rounded-md ml-auto mr-auto bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                    <span>Выбрать изображение</span>
                                                    <input id="file-upload" name="file" type="file" class="sr-only coach" required>
                                                </label>
                                            </div>
                                            <p class="mt-2 text-xs leading-5 text-gray-600">PNG, JPG, JPEG</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-full">
                                    <label for="aboutCoach" class="block text-sm font-medium leading-6 text-gray-900">Описание</label>
                                    <div class="mt-2">
                                <textarea id="aboutCoach" name="about" rows="3"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>{{ old('about') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="submit"
                                    class="rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Добавить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>

    @endif
@endsection



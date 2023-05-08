@extends('main')
@section('title', 'Добавление')
@section('content')
    <form class=" w-full
        w-100 h-100 px-2 xl:px-72 md:px-20 py-10" action="{{route('lessonAddAction')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="space-y-12">
            <div class=" pb-12">
                <a href="/lessonTable" type="button" class="  text-sm font-semibold leading-6 text-gray-600">Вернуться
                    назад</a>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name"
                               class="block text-sm font-medium leading-6 text-gray-900">Название</label>
                        <div class="mt-2">
                            <input type="text" name="lesson_name" id="lesson_name" autocomplete="given-name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('lesson_name') is-invalid @enderror" value="{{ old('lesson_name') }}">
                            @error('lesson_name')
                            <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Направление</label>
                        <div class="mt-2">
                            <select name="direction" autocomplete="country-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach ($directions as $d)
                                    <option value="{{$d->id_direction}}">{{$d->name_direction}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Краткое
                            описание</label>
                        <div class="mt-2">
                                <textarea id="about" name="about" rows="3"
                                          class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6 @error('about') is-invalid @enderror" >{{ old('about') }}</textarea>
                            @error('about')
                            <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Полное
                            описание</label>
                        <div class="mt-2">
                                <textarea id="about_all" name="about_all" rows="3"
                                          class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6 @error('about_all') is-invalid @enderror" >{{ old('about_all') }}</textarea>
                            @error('about_all')
                            <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="things" class="block text-sm font-medium leading-6 text-gray-900">Что с собой
                            взять</label>
                        <div class="mt-2">
                            <input type="text" name="things" id="things" autocomplete="family-name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('things') is-invalid @enderror" value="{{ old('things') }}">
                            @error('things')
                            <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Цена</label>
                        <div class="mt-2">
                            <input type="number" name="price" id="price" autocomplete="price" min="500" max="2000"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('price') is-invalid @enderror" value="{{ old('price') }}">
                            @error('price')
                            <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="photo" class="block sm:text-sm text-xs font-medium leading-6 text-gray-900">Загрузить
                            изображение</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <img src="/images/default.png" class="ml-auto mr-auto w-14 md:w-1/6"  id="img" />
                                <div class="py-2 flex text-sm leading-6 text-gray-600">
                                    <label for="file-upload"
                                           class="relative cursor-pointer rounded-md bg-white ml-auto mr-auto font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Выбрать изображение</span>
                                        <input id="file-upload" name="file" type="file" class="sr-only @error('file') is-invalid @enderror" value="{{ old('file') }}">
                                    </label>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG</p>
                            </div>
                        </div>
                        @error('file')
                        <div class="alert alert-danger">{{ 'Выберите изображение.' }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Добавить
            </button>
        </div>
    </form>

    <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
@endsection

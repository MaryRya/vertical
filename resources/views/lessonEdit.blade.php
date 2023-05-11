@extends('main')
@section('title', 'Изменение')
@section('content')
    @if (Auth::user()->id_role == 2)
        @foreach ($tableEdit as $table)
            <form class=" w-full
        w-100 h-100 px-2 xl:px-72 md:px-20 py-10 bg-[#f9f9fa]" action="{{ route('lessonEditAction') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_lesson" value="{{$table->id_lesson}}">
                <div class="space-y-12">
                    <div class=" pb-12">
                        <a href="/lessonTable" type="button" class="sm:text-sm text-xs font-semibold leading-6 text-gray-600">Вернуться назад</a>
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Название</label>
                                <div class="mt-2">
                                    <input type="text" name="lesson_name" id="lesson_name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$table->lesson_name}} @error('lesson_name') is-invalid @enderror" >
                                    @error('lesson_name')
                                    <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="country" class="block  text-sm font-medium leading-6 text-gray-900">Направление</label>
                                <div class="mt-2">
                                    <select id="direction" name="direction"  autocomplete="country-name" class="block w-full rounded-md  border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">

                                        @foreach($dance_direction as $dance)
                                            <option value="{{$dance->id_direction }} {{$dance->name_direction }}"
                                                    @if($dance->id_direction === $table->id_direction) selected
                                                @endif> {{$dance->name_direction}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Краткое описание</label>
                                <div class="mt-2">
                                    <textarea id="about" name="about" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6 @error('about') is-invalid @enderror">{{$table->lesson_description}}</textarea>
                                    @error('about')
                                    <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Полное описание</label>
                                <div class="mt-2">
                                    <textarea id="about" name="about_all" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6 @error('about_all') is-invalid @enderror">{{$table->lesson_description_all}}</textarea>
                                    @error('about_all')
                                    <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Что с собой взять</label>
                                <div class="mt-2">
                                    <input type="text" name="things" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('things') is-invalid @enderror" value="{{$table->things}}">
                                    @error('things')
                                    <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Цена</label>
                                <div class="mt-2">
                                    <input type="number" name="price" id="price" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('price') is-invalid @enderror" value="{{$table->lesson_price}}">
                                    @error('price')
                                    <div class="alert alert-danger">{{ 'Заполните поле.' }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Загрузить изображение</label>
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <img src="/images/{{$table->lesson_img}}" class="ml-auto mr-auto w-14 md:w-1/6"  id="img"/>
                                        <div class="mt-4 flex text-sm leading-6 text-gray-600" >
                                            <label for="file-upload" class="relative cursor-pointer ml-auto mr-auto rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Выбрать изображение</span>
                                                <input id="file-upload" name="file" type="file" class="sr-only @error('file') is-invalid @enderror" >
                                            </label>
                                        </div>
                                        <p class="mt-2 text-xs leading-5 text-gray-600">PNG, JPG, JPEG</p>
                                    </div>
                                </div>
                                @error('file')
                                <div class="alert alert-danger">{{ 'Выберите изображение.' }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Изменить</button>
                </div>
            </form>
            <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
        @endforeach
    @endif
@endsection

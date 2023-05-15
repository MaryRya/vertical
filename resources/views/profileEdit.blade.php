@extends('main')
@section('title', 'Изменение данных')
@section('content')

    <form class="flex flex-col md:px-40 px-6 mx-auto py-8 bg-[#f9f9fa]" action="{{ route('profileEditAction') }}" method="POST" style="min-height: 530px" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="w-full rounded-lg  md:mt-0 sm:max-w-md ">
            <h1 class="text-xl font-bold mb-5 leading-tight tracking-tight text-gray-900 md:text-2xl ">
                Личные данные
            </h1>
            <div class="space-y-4 md:space-y-6" >
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Имя, Фамилия</label>
                    <input required type="text" name="name" id="username" autocomplete="name" value="{{ Auth::user()->name }}" class=" bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " >
                    <input type="hidden" name="id"  value="{{ Auth::user()->id }}" />
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Электронная почта</label>
                    <input required id="email" name="email" type="email" value="{{ Auth::user()->email }}" autocomplete="email" class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Телефон</label>
                    <input required type="text"  name="phone" id="phone" class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ Auth::user()->phone}}">
                </div>

            </div>
        </div>
        @if (Auth::user()->id_role == 3)
            <div class="xl:w-3/5">
                <div class=" mb-3 mt-6">
                    <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Загрузить
                        изображение</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <img src="/images/coaches/{{ Auth::user()->photo}}" class="ml-auto mr-auto w-14 md:w-1/6"  id="img"/>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file-upload"
                                       class="relative cursor-pointer rounded-md ml-auto mr-auto bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Выбрать изображение</span>
                                    <input id="file-upload" name="file" type="file" class="sr-only coach">
                                </label>
                            </div>
                            <p class="mt-2 text-xs leading-5 text-gray-600">PNG, JPG, JPEG</p>
                        </div>
                    </div>
                </div>
                <div class=" mb-3 ">
                    <div class="mt-2">
                        <label  for="aboutCoach" class="block text-sm font-medium leading-6 text-gray-900">Описание</label>
                        <div class="mt-2">
                            <textarea type="text" id="aboutCoach" name="coach_description" class="h-24 border border-gray-300 text-gray-900 sm:text-sm rounded-lg bg-[#f9f9fa] block w-full " required >{{ Auth::user()->coach_description}} </textarea>
                        </div>
                    </div>

                </div>
            </div>
        @endif
        <div class="mt-4 flex items-center justify-end gap-x-6 ">
            <a href="/profile" class="rounded-md hover:bg-gray-100 sm:text-sm text-xs px-5 py-2.5 font-medium leading-6 text-gray-900">Вернуться назад</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-5 py-2.5 sm:text-sm text-xs font-medium text-white shadow-sm hover:bg-indigo-800 ">Сохранить</button>
        </div>
    </form>
    <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
@endsection

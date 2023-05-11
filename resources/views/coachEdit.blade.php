@extends('main')
@section('title', 'Изменнеие данных')
@section('content')
    @if (Auth::user()->id_role == 2)
        <div class="w-full
        w-100 h-100 px-2 xl:px-72 md:px-20 py-10 bg-[#f9f9fa]">
            <div class="space-y-12">
                <div class="pb-12">
                    <a href="/coachTable" type="button" class=" mb-2 sm:text-sm text-xs font-semibold leading-6 text-gray-600 hover:text-black">Вернуться назад</a>
                    @foreach ($users as $user)
                        <form action="{{ route('coachEditAction') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <h1 class="text-xl text-center font-semibold p-3 leading-tight tracking-tight text-gray-900">
                                    Изменение данных
                                </h1>
                                <div class="card-body mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <div class="sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Имя Фамилия</label>

                                            <input id="name" type="text" class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') is-invalid @enderror" name="name" required autocomplete="name"  placeholder="Иван Иванов" value="{{$user->name}}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Должность</label>
                                            <input readonly id="name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="тренер" value="тренер">
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Электронный адрес</label>
                                            <input id="email" type="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email') is-invalid @enderror" placeholder="name@example.com" name="email" required autocomplete="email" value="{{$user->email}}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Телефон</label>
                                        <input id="phone" type="number" class=" w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 "  name="phone" required autocomplete="new-phone" placeholder="89925555555" value="{{$user->phone}}">
                                    </div>
                                    <div class="col-span-full">
                                        <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Загрузить
                                            изображение</label>
                                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                            <div class="text-center">
                                                <img src="../images/coaches/{{$user->photo}}" class="ml-auto mr-auto w-14 md:w-1/6"   id="img"/>
                                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                    <label for="file-upload"
                                                           class="relative cursor-pointer rounded-md bg-white ml-auto mr-auto font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                        <span>Выбрать изображение</span>
                                                        <input id="file-upload" name="file" type="file" class="sr-only coach" required >
                                                    </label>
                                                </div>
                                                <p class="mt-2 text-xs leading-5 text-gray-600">PNG, JPG, JPEG</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-full">
                                        <label for="aboutCoach" class="block text-sm font-medium leading-6 text-gray-900">Описание</label>
                                        <div class="mt-2">
                                <textarea id="aboutCoach" name="about" rows="3" required
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{$user->coach_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button type="submit"
                                        class="rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Изменить
                                </button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
        <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
    @endif
@endsection

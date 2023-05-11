@extends('main')
@section('title', 'Личный кабинет')
@section('content')
        <form id="profile" class="flex flex-col md:px-40 px-6 mx-auto py-5" >
            <div  class="w-full bg-white rounded-lg  md:mt-0 sm:max-w-md  ">
                <h1 class="text-xl font-bold mb-5 leading-tight tracking-tight text-gray-900 md:text-2xl ">
                    Личные данные
                </h1>
                <div class="space-y-4 md:space-y-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Имя, Фамилия</label>
                        <input disabled type="text"  name="name" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg  block w-full p-2.5" value="{{ Auth::user()->name }}">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Электронная почта</label>
                        <input disabled type="email"  name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg  block w-full p-2.5" value="{{ Auth::user()->email }}">
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Телефон</label>
                        <input disabled type="text"  name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg  block w-full p-2.5" value="{{ Auth::user()->phone}}">
                    </div>
                </div>
            </div>
            @if (Auth::user()->id_role == 3)
                <div class="xl:w-3/5">
                    <div class=" mb-3 mt-6">
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <img src="/images/coaches/{{ Auth::user()->photo}}" class="ml-auto mr-auto w-14 md:w-1/6"  id="img"/>
                            </div>
                        </div>
                    </div>
                    <div class=" mb-3 ">
                        <label  for="aboutCoach" class="block text-sm font-medium leading-6 text-gray-900">Описание</label>
                        <div class="mt-2">
                            <textarea disabled type="text" id="aboutCoach" name="about" class="h-24 border border-gray-300 text-gray-900 sm:text-sm rounded-lg  block w-full " >{{ Auth::user()->coach_description}} </textarea>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mt-6 flex items-center justify-end gap-x-6 ">
                <a href="/" class="rounded-md hover:bg-gray-100 sm:text-sm text-xs md:px-5 px-1 py-2.5 font-medium leading-6 text-gray-900">Вернуться назад</a>
                <a href="/profileEdit" class=" rounded-md hover:bg-gray-100 sm:text-sm text-xs md:px-5 px-1 py-2.5 font-medium leading-6 text-gray-900">Изменить данные</a>
            </div>
        </form>

        @if (Auth::user()->id_role == 1)
            <div class=" flex w-full h-16 bg-indigo-50">
                <div class="items-center flex ml-auto mr-auto">
                    <p class="px-4  self-center text-xl font-semibold  text-center">Ваши занятия</p>
                </div>
            </div>
            <div id="table" class=" flex flex-col h-screen">
                <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-gray-200 border-b">
                                <tr>
                                    <th scope="col" class=" bg-indigo-100 text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    </th>
                                    <th scope="col" class=" bg-indigo-100 text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Занятие
                                    </th>
                                    <th scope="col" class="bg-indigo-100 text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Дата
                                    </th>
                                    <th scope="col" class="bg-indigo-100 text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Время
                                    </th>
                                    <th scope="col" class="bg-indigo-100 text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Зал
                                    </th>
                                    <th scope="col" class="bg-indigo-100 text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Тренер
                                    </th>
                                    <th scope="col" class="bg-indigo-100 text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $d)
                                    <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"></td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{$d->lesson_name}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{$d->date_lesson}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{mb_substr($d->start_time,0, 5)}} - {{mb_substr($d->end_time,0, 5)}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{$d->hall_name}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{$d->name}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <form method="POST" action="{{ route('cancelLesson') }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id_record" value="{{$d->id_record}}">
                                                <input type="hidden" name="id_schedule" value="{{$d->id_schedule}}">
                                                @if ($d->date_lesson < $datenow)
                                                @else
                                                    <button type="submit"
                                                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                        Отменить
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
@endsection

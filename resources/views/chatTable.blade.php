@extends('main')
@section('title', 'Вопросы')
@section('content')

    <div class="items-center px-5 py-10 xl:px-72 md:px-20 bg-[#f9f9fa]" style="min-height: 550px;">
        <a href="/adminIndex" type="button" class=" mb-5 sm:text-sm text-xs font-semibold leading-6 text-gray-600">Вернуться назад</a>
        <div class="overflow-hidden bg-white border border-1 border border-2 border-indigo-200 border-r-teal-100 shadow-indigo-200  shadow-md rounded-lg">
            <div class="px-4 py-5 sm:px-6  text-center  bg-indigo-600">
                <h3 class="sm:text-xl text-md text-center font-monospace leading-tight tracking-tight text-gray-900 md:text-xl text-white">Вопросы пользователей</h3>
            </div>
            <div class="border-t border-indigo-300">
                @foreach ($users as $user)
                    <div class=" flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div class="pt-2 flex">
                            <h1 class="text-sm font-medium text-gray-500 mr-2">{{$user->name}}</h1>
                            <a class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">({{$user->total}})</a>
                        </div>
                        <form action="{{ route('chat') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$user->id_user}}" name="id">

                            <button class=" flex items-center justify-center text-white bg-indigo-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-100 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 focus:outline-none"> Ответить</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

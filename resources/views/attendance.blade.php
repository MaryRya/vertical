@extends('main')
@section('title', 'Посещаемсть')
@section('content')

    <div class="items-center px-5 py-10 xl:px-72 md:px-20 bg-[#f9f9fa]" style="min-height: 500px;">
        <div class="flex flex-wrap items-center justify-between mb-5 px-5">
            <a href="/adminIndex" type="button" class="  sm:text-sm text-xs font-semibold leading-6 text-gray-600">Вернуться назад</a>
            <div class="w-full md:w-1/2 ">
                <form class="flex items-center" method="POST" action="{{route('attendance')}}">
                    {{ csrf_field() }}
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full flex">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                            <img class="w-5 h-5  mx-auto "
                                 src="/images/svg/search.svg" alt="search">
                        </div>
                        <input type="text" id="simple-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 mr-5" placeholder="Имя Фамилия" required="" name="search">
                        <button type="submit"
                                class="rounded-md bg-indigo-600 px-5 py-2.5 sm:text-sm text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Найти
                        </button>
                    </div>
                </form>
            </div>
            <div class=" mt-5 sm:mt-0">
                <form method="GET" action="/attendance/export">
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-5 py-2.5 sm:text-sm text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Скачать отчет
                    </button>
                </form>
            </div>
        </div>
        <div class="overflow-hidden bg-white border border-1 border border-2 border-indigo-200 border-r-teal-100 shadow-indigo-200  shadow-md rounded-lg">
            <div class="px-4 py-5 sm:px-6  text-center  bg-indigo-600">
                <h3 class="sm:text-xl text-md text-center font-monospace leading-tight tracking-tight text-gray-900 md:text-xl text-white">Посещаемость</h3>
            </div>
            <div class="border-t border-indigo-300">
                @foreach($data as $d)

                    <div class=" flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div class="pt-2 flex ">
                            <h1 class="md:text-sm text-xs text-gray-900 font-extrabold sm:col-span-2 sm:mt-0 mr-2">{{$d->name}}</h1>
                            <a class="md:text-sm text-xs font-bold text-gray-600 mr-2">{{$d->date_lesson}}</a>
                            <a class="md:text-sm text-xs font-semibold text-indigo-900 mr-2">{{$d->lesson_name}}</a>
                            <a class="md:text-sm text-xs font-semibold text-gray-700 mr-2">{{$d->lesson_price}} руб.</a>
                            <a class="md:text-sm text-xs font-medium text-gray-500 mr-2">{{$d->hall_name}}</a>
                        </div>
                        <div>
                            <a class="md:text-sm text-xs font-medium text-gray-500 mr-2">Присутсвие</a>
                            @if ($d->date_lesson == date("Y-m-d"))
                                @if ($d->attendance == 1)
                                    <input id="check_{{$d->id_record}}" onclick="terms_check({{$d->id_record}}, '{{ csrf_token() }}')" aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required checked>
                                @else
                                    <input id="check_{{$d->id_record}}" onclick="terms_check({{$d->id_record}}, '{{ csrf_token() }}')" aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required>
                                @endif
                            @else
                                @if ($d->attendance == 1)
                                <input aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required disabled  checked>
                                @else
                                    <input aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required disabled >
                                @endif

                            @endif
                            <a class="md:text-sm text-xs font-medium text-gray-500 mr-2">Присутсвие</a>
                            @if ($d->date_lesson == date("Y-m-d"))
                                @if ($d->attendance == 1)
                                    <input id="check_{{$d->id_record}}" onclick="terms_check({{$d->id_record}}, '{{ csrf_token() }}')" aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required checked>
                                @else
                                    <input id="check_{{$d->id_record}}" onclick="terms_check({{$d->id_record}}, '{{ csrf_token() }}')" aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required>
                                @endif
                            @else
                                @if ($d->attendance == 1)
                                    <input aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required disabled  checked>
                                @else
                                    <input aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required disabled >
                                @endif

                            @endif
                            <a class="md:text-sm text-xs font-medium text-gray-500 mr-2 ml-2">Оплата</a>
                            @if ($d->date_lesson == date("Y-m-d"))
                                @if ($d->pay == 1)
                                    <input id="check_{{$d->id_record}}" aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required checked>
                                @else
                                    <input id="check_{{$d->id_record}}" onclick="terms_check({{$d->id_record}}, '{{ csrf_token() }}')" aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required>
                                @endif
                            @else
                                @if ($d->pay == 1)
                                    {{$d->suc}}
                                    <input aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required disabled checked>
                                @else

                                    <input aria-describedby="terms" type="checkbox" name="terms" class=" border-gray-300 rounded  hover:bg-blue-700 " required disabled>
                                @endif
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>

@endsection

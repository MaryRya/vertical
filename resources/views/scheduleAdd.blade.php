@extends('main')
@section('title', 'Добавление занятий')
@section('content')
    <form class=" w-full bg-[#f9f9fa]
        w-100 h-100 px-2 xl:px-72 md:px-20 py-10" action="{{route('scheduleAction')}}" method="POST">
        {{ csrf_field() }}
        <div class="space-y-12">
            <div class=" pb-12">
                <a href="/adminIndex" type="button" class="sm:text-sm text-xs font-semibold leading-6 text-gray-600">Вернуться
                    назад</a>
                <div class="mt-10 grid grid-cols-1 gap-x-8 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Дата</label >
                        <div class="mt-2">
                            <input type="date" name="date_lesson" autocomplete="given-name" required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" id="date_shd">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="time"
                               class="block text-sm font-medium leading-6 text-gray-900">Время</label>
                        <div class="mt-2">
                            <select id="time" name="id_time_lesson" autocomplete="country-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach ($time_all as $dl)
                                    <option value="{{$dl['id_time_lesson']}}">{{$dl['start_time']}} - {{$dl['end_time']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="name"
                               class="block text-sm font-medium leading-6 text-gray-900">Название</label>
                        <div class="mt-2">
                            <select id="name" name="id_lesson" autocomplete="name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach ($dance_lesson as $dl)
                                    <option value="{{$dl->id_lesson}}">{{$dl->lesson_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="hall"
                               class="block text-sm font-medium leading-6 text-gray-900">Зал</label>
                        <div class="mt-2">
                            <select id="hall"  name="id_hall" autocomplete="hall"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach ($hall_all as $dl)
                                    <option value="{{$dl->id_hall}}"  >{{$dl->hall_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="coach"
                               class="block text-sm font-medium leading-6 text-gray-900">Тренер</label>
                        <div class="mt-2">
                            <select id="coach" name="id_user" autocomplete="coach"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach ($users_3 as $dl)
                                    <option value="{{$dl->id}}" id="usersel_{{$dl->id}}">{{$dl->name}}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Количесво мест</label >
                        <div class="mt-2">
                            <input type="number" name="count_places" readonly id="count" required min="1" max="5"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="5">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Повторяемость (дата окончания)</label >
                        <div class="mt-2">
                            <input type="date" name="date_end" autocomplete="given-name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" id="date_shd">
                        </div>
                    </div>
                    <div class="sm:col-span-3 flex mt-10">


                        <input id="fitbit" type="checkbox" value="w1"
                               class="w-4 h-4 bg-white border-gray-300 rounded text-primary-600 focus:ring-primary-500"  name="w1"/>
                        <label for="fitbit" class="ml-2 mr-2 text-sm font-medium text-gray-900 ">
                            Пн
                        </label>
                        <input id="fitbit" type="checkbox" value="w2"
                               class="w-4 h-4 bg-white border-gray-300 rounded text-primary-600 focus:ring-primary-500" name="w2"/>
                        <label for="fitbit" class="ml-2 mr-2 text-sm font-medium text-gray-900 ">
                            Вт
                        </label>
                        <input id="fitbit" type="checkbox" value="w3"
                               class="w-4 h-4 bg-white border-gray-300 rounded text-primary-600 focus:ring-primary-500"  name="w3"/>
                        <label for="fitbit" class="ml-2 mr-2 text-sm font-medium text-gray-900 ">
                            Ср
                        </label>
                        <input id="fitbit" type="checkbox" value="w4"
                               class="w-4 h-4 bg-white border-gray-300 rounded text-primary-600 focus:ring-primary-500"  name="w4"/>
                        <label for="fitbit" class="ml-2 mr-2 text-sm font-medium text-gray-900 ">
                            Чт
                        </label>
                        <input id="fitbit" type="checkbox" value="w5"
                               class="w-4 h-4 bg-white border-gray-300 rounded text-primary-600 focus:ring-primary-500"  name="w5"/>
                        <label for="fitbit" class="ml-2 mr-2 text-sm font-medium text-gray-900 ">
                            Пт
                        </label>
                        <input id="fitbit" type="checkbox" value="w6"
                               class="w-4 h-4 bg-white border-gray-300 rounded text-primary-600 focus:ring-primary-500"  name="w6"/>
                        <label for="fitbit" class="ml-2 mr-2 text-sm font-medium text-gray-900 ">
                            Сб
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" id="successButton"
                    class="rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Добавить
            </button>
        </div>
    </form>
    @if (app('request')->input('action') == 1)
        <div id="successModal" tabindex="-1" aria-hidden="true" class="fixed w-full ">
            <div class="relative p-4 w-full bg-indigo-200 rounded-lg max-w-md md:h-auto">
                <div class="relative p-4  text-center bg-white rounded-lg shadow sm:p-5">
                    <a href="/scheduleAdd/">
                        <img class="w-7 h-7 absolute top-2.5 right-2.5 rounded-lg text-sm p-1.5 ml-auto"
                             src="/images/svg/close.svg">
                    </a>
                    <img class="w-9 h-9 mb-2 mx-auto"
                         src="/images/svg/successfully.svg">
                    <p class="mb-4 text-lg font-semibold text-gray-900 ">Успешно добавлено!</p>
                    <div class="flex justify-center items-center space-x-4">
                        <a href="/schedule" class="mb-1 hover:bg-indigo-800 flex items-center justify-center rounded-md font-semibold text-sm px-2 py-1.5 md:px-3 bg-indigo-600 text-white md:py-2 "> Открыть расписание</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
    <script type="text/javascript">

        // function chengehall(){
        //     console.log(this);
        // }

        var sel = document.getElementById('hall');

        sel.onchange = function () {

            var id=this.options[this.selectedIndex].value;

            $.ajax({
                url: "/hallcountget",
                type:"GET",
                data:{
                    "_token": "{{ csrf_token() }}",
                    id:id,
                },
                success:function(response){
                    if(response !== 500){
                        //window.location = "/schedule";
                        //console.log(response['count']);
                        document.getElementById('count').value = response['count']
                    }
                },
            });

        };

        var sel = document.getElementById('name');

        sel.onchange = function () {

            var id=this.options[this.selectedIndex].value;

            $.ajax({
                url: "/dancenamegetusers",
                type:"GET",
                data:{
                    "_token": "{{ csrf_token() }}",
                    id:id,
                },
                success:function(response){
                    if(response !== 500){
                        //window.location = "/schedule";
                        //console.log(response['count']);
                        //document.getElementById('count').value = response['count']
                        console.log(response);
                        if(response['id_user'] !== 0){
                            let a = document.getElementById('usersel_'+response['id_user']);
                            a.selected = true;
                        }

                    }
                },
            });

        };
    </script>
@endsection

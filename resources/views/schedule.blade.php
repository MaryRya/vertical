@extends('main')
@section('title', 'Расписание')
@section('content')
    <div class="flex justify-end pt-4 px-0 xl:px-40 bg-[#f9f9fa]">
        <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                class="text-white bg-[#7179b9] hover:bg-indigo-800 font-medium rounded-md text-sm px-4 py-2.5 text-center inline-flex items-center"
                type="button">
            Фильтры
        </button>
        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg border-indigo-400 border shadow-md shadow-indigo-300">
            <h6 class="mb-3 text-md font-medium text-black dark:text-white">
                 Направления
            </h6>
            <form action="/schedule" method="POST">
                {{ csrf_field() }}
            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                @foreach($dance_directions as $dd)
                <li class="flex items-center">
                    @if(in_array($dd->id_direction, $arr_n))

                        <input name="p_{{$dd->id_direction}}" type="checkbox" value="{{$dd->id_direction}}"
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500" checked />
                    @else

                        <input name="p_{{$dd->id_direction}}" type="checkbox" value="{{$dd->id_direction}}"
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500" />
                    @endif


                    <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{$dd->name_direction}}
                    </label>
                </li>
                @endforeach
            </ul>

            <h6 class="mt-3 mb-3 text-md font-medium text-black ">
                Тренеры
            </h6>
            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">

                @foreach($users as $user)

                <li class="flex items-center">

                    @if(in_array($user['id'], $arr_p))


                    <input name="u_{{$user['id_number']}}" type="checkbox" value="{{$user['id']}}"
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500" checked />
                    @else

                    <input name="u_{{$user['id_number']}}" type="checkbox" value="{{$user['id']}}"
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500" />


                    @endif

                    <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{$user['name']}}
                    </label>
                </li>
                @endforeach
            </ul>

            <button class="text-white bg-[#7179b9] hover:bg-indigo-800 font-medium rounded-md text-sm mt-2 px-2 py-1 text-center inline-flex items-center">Применить</button>
        </form>
        </div>
    </div>

    <div id="cal" class="xl:p-40 xl:py-5 p-5 bg-[#f9f9fa]">
        <div id='calendar' class="bg-white"></div>
    </div>
    <div id="medium-modal-1" tabindex="-2"
         class="fixed top-0 left-0 right-0 z-50 hidden  p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div  id="card" class="relative w-full h-full max-w-lg md:h-auto">
            <div  class="relative  rounded-lg shadow border-4 border-t-2 border-indigo-300 border-r-teal-100 shadow-indigo-300  shadow-lg">
                <form  method="POST" action="{{ route('enrollLesson') }}">
                    {{ csrf_field() }}
                    <div class="flex bg-indigo-50 items-center justify-between p-3 border-b rounded-t">
                        <h3 id="date">
                            <input class="sm:text-xl pl-3 bg-indigo-50 text-md font-medium text-gray-900 border-none" type="text" id="title" readonly>
                        </h3>
                        <a href="/schedule">
                            <img  class="w-5 h-5 mr-2" src="/images/svg/close.svg">
                        </a>
                    </div>
                    <div class="p-6 pb-0 space-y-6 bg-indigo-50">
                        <p readonly id="description" class="sm:text-base text-sm leading-relaxed bg-indigo-50 text-gray-900"></p>
                        <input type="hidden" name="id_schedule" id="id_schedule">
                        <input type="hidden" name="date_r" id="date_r">
                        <input type="hidden" name="id_user" id="id_user">
                        <div class="pb-2">
                            <span class="font-medium sm:text-base text-sm">Стоимость: </span>
                            <input type="text" id="price" readonly class="bg-indigo-50 sm:text-base text-sm font-medium border-none w-10 p-1">руб. <br>
                            <input type="hidden" name="id_time" id="id_time" value="">
                            <span class="font-medium sm:text-base text-sm">Время занятий: </span>
                            <input type="text" id="time" readonly class="bg-indigo-50 sm:text-base text-sm font-medium border-none w-40 p-1"><br>
                            <span class="font-medium sm:text-base text-sm">Тренер: </span>
                            <input type="text" id="coach" readonly class="bg-indigo-50 sm:text-base text-sm font-medium border-none p-1"><br>
                            <span class="font-medium sm:text-base text-sm">Количество свободных мест: </span>
                            <input type="text" name="count" id="count" readonly class="bg-indigo-50 sm:text-base text-sm w-10 font-medium border-none p-1"><br />
                            <span class="font-medium sm:text-base text-sm">Зал: </span>
                            <input type="text" id="hall" readonly class="bg-indigo-50 sm:text-base text-sm font-medium border-none w-40 p-1">
                            <div class=" pt-2" style="display: none" id="desc_all_show">
                                <div class="pb-2 text-black" id="description_all"></div>
                                <span class="font-medium sm:text-base text-sm text-black">Что с собой взять: </span>
                                <textarea type="text" id="things" readonly class=" bg-indigo-50 sm:text-base text-sm font-medium border-none w-full p-1 text-black"> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between p-6 space-x-2 bg-indigo-50 border-t border-gray-200 rounded-b">
                        @if (Auth::check())
                            @if (Auth::user()->id_role == 1)
                                <button type="submit" id="sub_z" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center" >Записаться</button>
                                <a href="#" onclick="checkDescription()"  id="desc_all_hide"
                                   class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center" >Подробнее</a>
                            @endif
                            @if (Auth::user()->id_role == 2)
                                <a style="cursor: pointer" onclick="deleteScheduleAjax('{{ csrf_token() }}')"
                                   class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center" >Удалить</a>
                            @endif
                        @else
                            <label for="terms" class="px-2"> Чтобы записаться необходимо<a
                                    class="font-medium text-primary-600 hover:underline" href="/register">
                                    зарегистрироваться</a> или <a class="font-medium text-primary-600 hover:underline" href="/login" target="_blank">войти</a>
                            </label>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var events = <?=$data?>;
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                selectable: true,
                editable: {{(auth()->check() && (auth()->user()->id_role == 2))?true:0}},
                dayMaxEvents: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
                },
                eventClick: function(info){
                    console.log(info);
                    var el = document.getElementById("medium-modal-1");
                    el.style.display = "block"
                    document.getElementById("title").value = info.event.title;
                    $.ajax({
                        url: "/cardLesson",
                        type:"POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            id:info.event.id,
                            date:info.event.startStr,
                            id_schedule: info.event.groupId,
                        },
                        success:function(response){
                            if(response !== 500){
                                cardLessonInfo(response);
                            }
                        },
                    });
                },

                buttonText:{
                    today:'сегодня',
                    month:'месяц',
                    week:'неделя',
                    day:'день',
                    list:'список'},
                timeZone: 'UTC',
                slotMinTime: "10:00:00",
                slotMaxTime: "21:00:00",
                slotDuration: '01:00',
                firstDay: 1,
                stickyHeaderDates:true,
                handleWindowResize:false,
                expandRows: true,
                allDaySlot: false,
                theme: true,
                locale: 'ru',
                eventDrop: function( eventDropInfo ) {
                    if(eventDropInfo.event.startStr < getNowDate()){
                        alert('Error!');
                    }
                    else{
                        $.ajax({
                            url: "/scheduleChange",
                            type:"POST",
                            data:{
                                "_token": "{{ csrf_token() }}",
                                date:eventDropInfo.event.startStr,
                                id_schedule: eventDropInfo.event.groupId
                            },
                            success:function(response){
                                if(response !== 500){
                                    console.log(response);
                                }
                            },
                        });
                    }
                },
                eventSources : [
                    {
                        events : events,
                        color : '#7060FB ',
                    }
                ],
            });
            calendar.render();
        });
        //let f = window.location.href;

    </script>
    <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
@endsection

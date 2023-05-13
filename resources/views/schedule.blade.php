@extends('main')
@section('title', 'Расписание')
@section('content')

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
    </script>
    <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
@endsection

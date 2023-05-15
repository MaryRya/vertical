@extends('main')
@section('title', 'АдминПанель')
@section('content')
    @if (Auth::user()->id_role == 2)
        <div class="items-center min-h-full px-5 py-10 xl:px-72 md:px-20 bg-[#f9f9fa]">
            <div class="w-full max-w-screen-xl py-5 mx-auto ">
                <!-- Start coding here -->
                <div class="relative bg-indigo-50 overflow-hidden bg-white border-2 border-indigo-200 border-r-teal-100 shadow-md shadow-indigo-200 rounded-lg">
                    <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div>
                            <h5 class="mr-3 font-semibold ">Расписание</h5>
                            <p class="text-gray-500 ">Добавить занятие в расписание</p>
                        </div>
                        <a href="/scheduleAdd" class=" flex items-center justify-center text-white bg-indigo-600  hover:bg-indigo-800 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 "> Добавить</a>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-screen-xl py-5  mx-auto ">
                <!-- Start coding here -->
                <div class="relative bg-indigo-50 overflow-hidden bg-white border-2 border-indigo-200 border-r-teal-100 shadow-md shadow-indigo-200 rounded-lg">
                    <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div>
                            <h5 class="mr-3 font-semibold">Занятия</h5>
                            <p class="text-gray-500 ">Добавление/изменение/удаление занятий</p>
                        </div>
                        <a href="/lessonTable" class=" flex items-center border  border-gray-900/25 justify-center text-white bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 "> Открыть</a>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-screen-xl py-5 mx-auto ">
                <!-- Start coding here -->
                <div class="relative bg-indigo-50 overflow-hidden bg-white border-2 border-indigo-200 border-r-teal-100 shadow-md shadow-indigo-200 rounded-lg">
                    <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div>
                            <h5 class="mr-3 font-semibold ">Тренеры</h5>
                            <p class="text-gray-500 ">Добавление/изменение/удаление тренера </p>
                        </div>
                        <a href="/coachTable" class=" flex items-center justify-center text-white bg-indigo-600  hover:bg-indigo-800  font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 "> Открыть</a>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-screen-xl py-5  mx-auto">
                <!-- Start coding here -->
                <div class="relative bg-indigo-50 overflow-hidden bg-white border-2 border-indigo-200 border-r-teal-100 shadow-md shadow-indigo-200 rounded-lg">
                    <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div>
                            <h5 class="mr-3 font-semibold">Чат {{ ($count_q != 0) ?  '('.$count_q.')' : ''}}</h5>
                            <p class="text-gray-500 ">Ответить пользователю</p>
                        </div>
                        <a href="/chatTable" class=" flex items-center justify-center text-white bg-indigo-600  hover:bg-indigo-800 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 "> Открыть</a>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-screen-xl py-5  mx-auto">
                <!-- Start coding here -->
                <div class="relative bg-indigo-50 overflow-hidden bg-white border-2 border-indigo-200 border-r-teal-100 shadow-md shadow-indigo-200 rounded-lg">
                    <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div>
                            <h5 class="mr-3 font-semibold ">Посещаемость</h5>
                            <p class="text-gray-500 ">Отметить посещение</p>
                        </div>
                        <a href="/attendance" class=" flex items-center justify-center text-white bg-indigo-600  hover:bg-indigo-800 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 "> Открыть</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

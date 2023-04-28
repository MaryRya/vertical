@extends('main')

@section('content')
    @if (Auth::user()->id_role == 2)
        <div class="items-center px-5 py-10 xl:px-72 md:px-20">
            <div class="flex flex-wrap items-center justify-between mb-5 px-5">
            <a href="/adminIndex" type="button" class="  sm:text-sm text-xs font-semibold leading-6 text-gray-600">Вернуться назад</a>
                <div>
                    <a type="button" href="/lessonAdd/" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-800 ">Добавить</a>
                </div>
            </div>
            <div class="overflow-hidden bg-white border border-1 border border-2 border-indigo-200 border-r-teal-100 shadow-indigo-200  shadow-md rounded-lg">
                <div class="px-4 py-5 sm:px-6  text-center bg-indigo-600">
                    <h3 class="sm:text-xl text-md text-center font-monospace leading-tight tracking-tight text-gray-900 md:text-xl  text-white">Занятия</h3>
                </div>
                @foreach($data as $d)
                    <div class="border-t border-indigo-300">
                        <div class="flex  justify-between p-4 space-y-2 sm:flex sm:space-y-0 sm:space-x-4">
                            <div class="">
                                <h1 class="text-sm font-semibold text-gray-900">{{$d->lesson_name}}</h1>
                                <a class=" mt-1 text-sm text-gray-500 sm:col-span-2 sm:mt-0">{{$d->name_direction}}</a>
                            </div>
                            <div class=" md:flex">
                                <a href="/lessonEdit/{{$d->id_lesson}}/" class=" mb-1 flex items-center hover:bg-indigo-600  hover:text-white justify-center  rounded-lg text-sm font-medium px-2 py-1 md:px-3 md:py-2 mr-1 md:mr-2 "> Изменить</a>
                                    <button id="deleteButton" data-modal-toggle="deleteModal-{{$d->id_lesson}}" class="mb-1 flex items-center justify-center text-red-600  rounded-lg font-semibold text-sm px-2 py-1 md:px-3 hover:bg-red-500 hover:text-white md:py-2 mr-1 md:mr-2  border border-red-300 shadow-md shadow-red-300" type="button">
                                        Удалить
                                    </button>
                                <!-- Main modal -->
                                <div id="deleteModal-{{$d->id_lesson}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative p-4 text-center bg-white rounded-lg shadow  sm:p-5">
                                            <button>
                                            <img class="w-7 h-7 absolute top-2.5 right-2.5 rounded-lg text-sm p-1.5 ml-auto"
                                                 src="/images/svg/close.svg" data-modal-toggle="deleteModal-{{$d->id_lesson}}">
                                            </button>
                                            <img class="w-7 h-7 mb-2 mx-auto"
                                                 src="/images/svg/delete.svg">
                                            <p class="mb-4 text-gray-500">Вы уверены, что хотите удалить {{$d->lesson_name}}?</p>
                                            <div class="flex justify-center items-center space-x-4">
                                                <button data-modal-toggle="deleteModal-{{$d->id_lesson}}" type="button" class="py-2 px-3 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:z-10">
                                                    Отмена
                                                </button>
                                                <a href="/lessonDelete/{{$d->id_lesson}}/" class="mb-1 flex items-center justify-center rounded-lg font-semibold text-sm px-2 py-1.5 md:px-3 bg-red-500 text-white md:py-2 mr-1 md:mr-2 "> Удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    @endif
@endsection

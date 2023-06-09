@extends('main')
@section('title', 'Главная')
@section('content')
    <body class="bg-[#f9f9fa]">
    <section class="bg-[#f9f9fa] ">
        <div class="gap-16 items-center px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 pb-6">
            <div class="font-light text-gray-700 sm:text-lg ">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 ">Ощути свободу движений</h2>
                <p class="mb-4">Vertical - команда тех, кто любит движение и драйв, мы помогаем создавать красивые тела
                    и выражать эмоции через танцевальные и гимнастические направления.
                    Вернем вам стройность и гибкость, силу и тонус, научим танцевать и трюкачить в том стиле, который вы
                    выберете.
                </p>
                <p>Добро пожаловать в мир фитнеса, воздушной гимнастики и танцев!</p>
            </div>
            <div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <img class="w-full rounded-lg" src="/images/blog/car2.jpg" alt="office content 1">
                    <img class="mt-4 w-full lg:mt-10 rounded-lg" src="/images/blog/vert.jpg" alt="office content 2">
                </div>
            </div>
        </div>
    </section>
    @foreach($dance as $dan)
        <div id="direction" class=" flex mx-auto h-16 bg-[#e0e0f5] max-w-7xl rounded-md">
            <div class="items-center flex mx-auto">
                <img src="images/svg/{{$dan->img_direction}}" class="h-6 items-center sm:h-9"/>
                <p class="px-4 md:px-1 self-center text-xl sm:text-2xl font-semibold">{{$dan->name_direction}}</p>
            </div>
        </div>

        <div id="lesson" class="flex flex-wrap  gap-5 justify-center p-5">
            @foreach($dan->mass as $d)
                <div
                    class="max-w-xs xl:max-w-sm h-[550px] bg-white border-2 border-indigo-200 border-b-teal-100 border-t-teal-100 rounded-lg shadow-md">
                    <img class="rounded-t-lg w-full h-1/2" src="images/{{$d->lesson_img}}" alt=""/>
                    <div class=" relative  p-5 h-2/4">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{$d->lesson_name}}</h5>
                        <p class="mb-3 font-normal text-gray-700 ">
                            {{$d->lesson_description}}
                        </p>
                        <div class="  pb-5 pr-10 bottom-0 absolute w-full">
                            <span class="font-medium ">Стоимость: {{$d->lesson_price}} руб.</span>
                            <div class="xl:flex pt-3 ">
                                <!-- Modal toggle -->
                                <button data-modal-target="medium-modal-{{$d->id_lesson}}"
                                        data-modal-toggle="medium-modal-{{$d->id_lesson}}"
                                        class=" mb-1 mr-auto inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white  bg-indigo-600 hover:bg-indigo-800 rounded-lg ">
                                    Подробнее
                                    <img class="mr-auto w-4 h-4 ml-2 -mr-1" src="/images/svg/arrow.svg">
                                </button>
                                <div id="medium-modal-{{$d->id_lesson}}" tabindex="-1"
                                     class="fixed top-0 left-0 right-0 z-50 hidden  p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                    <div class="relative w-full h-full max-w-lg md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <div
                                                class="flex items-center justify-between p-5 border-b rounded-t">
                                                <h3 class="text-xl font-medium text-gray-900 ">
                                                    {{$d->lesson_name}}
                                                </h3>
                                                <button>
                                                    <img
                                                        class="w-7 h-7 absolute top-2.5 right-2.5 rounded-lg text-sm p-1.5 ml-auto"
                                                        src="/images/svg/close.svg"
                                                        data-modal-hide="medium-modal-{{$d->id_lesson}}">
                                                </button>
                                            </div>
                                            <div class="p-6 space-y-6 ">
                                                <p class="text-base leading-relaxed text-gray-500 ">
                                                    {{$d->lesson_description_all}}
                                                </p>
                                                <div class="pb-2">
                                                    <span class="font-medium ">Что с собой взять: {{$d->things}}</span>
                                                </div>
                                                <span
                                                    class="font-medium pb-5">Стоимость: {{$d->lesson_price}} руб.</span>
                                            </div>
                                            <div
                                                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b ">
                                                <a href="/schedule" {{--data-modal-hide="medium-modal"--}} type="button"
                                                   class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Записаться</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/schedule"
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white  bg-indigo-500 hover:bg-indigo-700 rounded-lg  focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                    Записаться
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach


    <section id="team">
        <div class="py-8 px-6 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 ">
                <h2 class="mb-4 text-3xl md:text-4xl tracking-tight font-extrabold text-gray-900">Наша команда</h2>
                <p class="font-light text-gray-700 lg:mb-8 sm:text-xl ">Можно работать и год, и два, и много-много лет,
                    а тренером так и не стать. Однако наши тренеры реализовали себя в профессиональном плане и нашли
                    свое призвание, по велению свыше!
                </p>
            </div>
            <div class="grid gap-8 mb-2 md:grid-cols-2">
                @foreach ($users as $user)
                    <div class="items-center bg-[#dad9fa] rounded-lg shadow-xl shadow-[#e0e0f5] sm:flex ">
                        <img class=" md:h-full sm:w-1/2 rounded-lg sm:rounded-none sm:rounded-l-lg"
                             src="images/coaches/{{$user->photo}}"
                             alt="{{$user->name}}">
                        <div class="p-5">
                            <h3 class="text-xl font-bold tracking-tight text-black ">
                                <a>{{$user->name}}</a>
                            </h3>
                            <span class="text-gray-500 ">{{$user->name_role}}</span>
                            <p class="mt-3 mb-4 font-light text-gray-900 ">{{$user->coach_description}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="border-2 border-indigo-400 rounded-xl mx-10 mb-10">
        <div class="flex w-full">
            <div class="items-center flex mx-auto py-5">
                <p class="text-3xl md:text-4xl tracking-tight font-extrabold text-gray-900">Наши преимущества</p>
            </div>
        </div>
        <div class="font-light text-gray-700 sm:text-xl mx-auto mx-14 pb-10 pt-5 px-5">
            <div class="md:flex md:justify-between">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-8 xl:grid-cols-4">
                    <a>❤ Современные, просторные и уютные залы, оборудованные всем необходимым для эффективных
                        занятий.</a>
                    <a>❤ Профессиональные инструкторы, тренеры и хореографы, любящие свое дело и своих клиентов.</a>
                    <a>❤ Небольшие группы для занятий, что позволяет обеспечить индивидуальный подход к каждому
                        ученику.</a>
                    <a>❤ По любому из выбранных направлений - обучение с нуля.</a>
                </div>
            </div>
        </div>
    </div>
    <div id="reviews" class="  flex mx-auto h-16 bg-[#e0e0f5] max-w-7xl rounded-md">
        <div class="items-center flex ml-auto mr-auto">
            <p class="px-4 text-xl sm:text-2xl font-semibold  text-center">Отзывы</p>
        </div>
    </div>
    <section id="reviews" class=" py-8 lg:py-5">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
            </div>
            @guest
                <form class="mb-6" onsubmit="return false">
                    @else

                        <form class="mb-6" action="{{ route('reviewAction') }}" method="POST">
                            @csrf
                            @endguest
                            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border-4 border-indigo-300 border-b-teal-200 border-t-teal-100 ">
                               <textarea id="comment" rows="6"
                                         class="px-0 w-full text-sm text-gray-900 border-0  focus:ring-0 focus:outline-none"
                                         placeholder="Напишите отзыв" name="text" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                @if(auth()->check() && auth()->user()->id_role == 2)

                                @else
                                    @guest
                                        <button id="deleteButton" data-modal-toggle="deleteModal"
                                                class="block text-white bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center "
                                                name="btnaction">
                                            Отправить
                                        </button>
                                    @else
                                        <button
                                            class="block text-white  bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center "
                                            name="btnaction">
                                            Отправить
                                        </button>
                                    @endguest

                                @endif

                            </div>
                        </form>

                        <div id="deleteModal" tabindex="-1" aria-hidden="true"
                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <div class="relative p-4 text-center bg-white rounded-lg shadow  sm:p-5">
                                    <button>
                                        <img class="w-7 h-7 absolute top-2.5 right-2.5 rounded-lg text-sm p-1.5 ml-auto"
                                             src="/images/svg/close.svg" data-modal-toggle="deleteModal">
                                    </button>
                                    <label for="terms" class="px-2"> Чтобы оставить отзыв необходимо<a
                                            class="font-medium text-primary-600 hover:underline" href="/register">
                                            зарегистрироваться</a> или <a class="font-medium text-primary-600 hover:underline" href="/login">войти</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @foreach($reviews as $review)
                            <article class="p-6 mb-6 text-base bg-white border-2 border-indigo-300 border-r-teal-200 rounded-lg ">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 ">{{$review->name}}</p>
                                        <p class="text-sm text-gray-600 ">
                                            <time datetime="2022-02-08" class="font-light">{{$review->date}}
                                            </time>
                                        </p>
                                    </div>
                                </div>
                                <p class="text-gray-800 mb-3">
                                    {{$review->text}}
                                </p>
                                @if ($review->response == null)
                                    @if(auth()->check() && auth()->user()->id_role == 2)

                                        <a id="reviews_admin_{{$review->id_review}}" onclick="checkAnswer({{$review->id_review}})" class=" text-white  bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-3 py-2 text-center mb-5 ">Ответить</a>

                                        <div style="display: none;" id="admin_reviews_{{$review->id_review}}">
                                            <div class="mb-6 mt-6">

                                                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border-4 border-indigo-300 border-b-teal-200 border-t-teal-100 ">
                               <textarea id="comment_{{$review->id_review}}" rows="6"
                                         class="px-0 w-full text-sm text-gray-900 border-0  focus:ring-0 focus:outline-none"
                                         placeholder="Напишите ответ" name="text" required></textarea>
                                                </div>
                                                <div class="flex justify-end">

                                                    <button id="deleteButton"
                                                            class="block text-white bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center "
                                                            name="btnaction" onclick="reviewadd({{$review->id_review}}, '{{ csrf_token() }}')">
                                                        Отправить
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="bg-[#EDEBF1] rounded-lg px-3 ">
                                        <div class="flex justify-between items-center mb-2 mt-5 pt-2">
                                            <div class="flex items-center">
                                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 ">Администратор</p>
                                            </div>
                                        </div>
                                        <p class="text-gray-800 pb-3">
                                            {{$review->response}}
                                        </p>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                        <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
                        <div class="flex justify-end">
                            <button id="reviews_all" onclick="checkReviews()"
                                    class=" block text-white  bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-5">
                                Показать все отзывы
                            </button>
                        </div>
                        <div style="display: none;" id="all_reviews">
                            @foreach($reviews_all as $review)
                                <article class="p-6 mb-6 text-base  bg-white border-2 border-indigo-200 border-r-teal-100 rounded-lg ">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center">
                                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 ">
                                                {{$review->name}}</p>
                                            <p class="text-sm text-gray-600 ">
                                                <time datetime="2022-02-08"
                                                      title="February 8th, 2022">{{$review->date}}
                                                </time>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="text-gray-800 text-md pb-3">
                                        {{$review->text}}
                                    </p>

                                    @if ($review->response == null)
                                        @if(auth()->check() && auth()->user()->id_role == 2)

                                            <a id="reviews_admin_{{$review->id_review}}" onclick="checkAnswer({{$review->id_review}})" class=" text-white  bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-3 py-2 text-center mb-5 ">Ответить</a>

                                            <div style="display: none;" id="admin_reviews_{{$review->id_review}}">
                                                <div class="mb-6 mt-6">

                                                    <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border-4 border-indigo-300 border-b-teal-200 border-t-teal-100 ">
                               <textarea id="comment_{{$review->id_review}}" rows="6"
                                         class="px-0 w-full text-sm text-gray-900 border-0  focus:ring-0 focus:outline-none"
                                         placeholder="Напишите ответ" name="text" required></textarea>
                                                    </div>
                                                    <div class="flex justify-end">

                                                        <button id="deleteButton"
                                                                class="block text-white bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center "
                                                                name="btnaction" onclick="reviewadd({{$review->id_review}}, '{{ csrf_token() }}')">
                                                            Отправить
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else

                                        <div class="bg-[#EDEBF1] rounded-lg px-3 ">
                                            <div class="flex justify-between items-center mb-2 mt-5 pt-2">
                                                <div class="flex items-center">
                                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 ">Администратор</p>
                                                </div>
                                            </div>
                                            <p class="text-gray-800 pb-3">
                                                {{$review->response}}
                                            </p>
                                        </div>
                                    @endif

                                </article>
                            @endforeach
                        </div>
                </form>
        </div>
    </section>

    <script>

        function reviewadd(id_rev, token){
            let txt_message = document.getElementById('comment_'+id_rev).value;
            $.ajax({
                url: "/reviewadd",
                type:"POST",
                data:{
                    "_token":  token,
                    id_rev:id_rev,
                    txt_message:txt_message
                },
                success:function(response){
                    if(response !== 500){
                        window.location = "/";



                    }
                },
            });

        }

        function checkAnswer(id){
            if(document.getElementById("admin_reviews_"+id).style.display === "none"){
                document.getElementById("admin_reviews_"+id).style.display = "block";
                document.getElementById("reviews_admin_"+id).textContent = "Скрыть";
            }
            else{
                document.getElementById("admin_reviews_"+id).style.display = "none";
                document.getElementById("reviews_admin_"+id).textContent = "Ответить";
            }
        }
    </script>
    </body>

@endsection


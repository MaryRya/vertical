@extends('main')
@section('title', 'Чат')
@section('content')

    <form class="w-full h-screen relative bg-[#f9f9fa]
        w-100 h-100 px-2 xl:px-72 md:px-20 pt-10" onsubmit="return false">
        <div class="space-y-15">
            <div class=" pb-5">
                <a href="/adminIndex" type="button" class="sm:text-sm text-xs font-semibold leading-6 text-gray-600">Вернуться
                    назад</a>
                @if (Auth::user()->id_role == 1)
                    <h2 class="text-md px-5 py-2 text-center font-monospace leading-tight tracking-tight text-gray-900 md:text-xl  text-black">Здравствуйте! На какой вопрос Вы хотите получить ответ?</h2>
                @endif
                <div id="res" class="h-[300px] xl:h-[400px] "></div>
            </div>
            <div id="textsent" class="grid gap-x-4 gap-y-2 grid-cols-6 md:ml-10 flex bottom-0 ">
                <div id="chatspan" class=" pt-5 col-span-5">
                    <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border-4 border-indigo-300 border-b-teal-200  ">
                        <textarea id="question" name="question"  class="px-0 w-full text-sm text-gray-900 border-0  focus:ring-0 focus:outline-none" placeholder="Напишите... "></textarea>
                    </div>
                </div>
                <div id="sentbtn" class="mb-5 pt-10 mr-5">
                    <button type="submit" id="btn_chat"
                            class="rounded-md bg-indigo-600  px-5 py-2.5 md:text-sm text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Отправить
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
    <script type="text/javascript">
        function ajaxGetMessage(){
            $.ajax({
                url: "/chatAjax",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    suc:1
                },
                success:function(response){
                    if(response !== 500){
                        var res = "";
                        for (var i = 0; i < response.data.length; i++) {
                            res += ChatGetAjax1(response.data[i]);
                            if(response.data[i].answer != null){
                                res += ChatGetAjax2(response.data[i]);
                            }
                        }
                        document.getElementById("res").innerHTML = res;
                    }
                },
            });
        }
        function ajaxMessage() {
            let message = document.getElementById("question").value;
            if(message.length > 5){
                $.ajax({
                    url: "/chatAjax",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        suc:0,
                        question:message,
                    },
                    success:function(response){
                        if(response !== 500){
                            var res = "";
                            for (var i = 0; i < response.data.length; i++) {
                                res += ChatGetAjax1(response.data[i]);
                                if(response.data[i].answer != null){
                                    res += ChatGetAjax2(response.data[i]);
                                }
                            }
                            document.getElementById("res").innerHTML = res;
                            document.getElementById("question").value = '';
                        }
                    },
                });
            } else{
                alert('Введите сообщение большей длины!');
            }
        }

        let btn = document.getElementById("btn_chat");
        btn.addEventListener('click', function(){
            ajaxMessage();
        });
        setInterval(ajaxGetMessage, 1000);
    </script>
@endsection

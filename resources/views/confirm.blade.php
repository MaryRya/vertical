@extends('main')
@section('title', 'Личный кабинет')
@section('content')
    <div class="h-screen bg-[#f9f9fa] pt-5">
        <form class="w-[500px]  mx-auto  p-7 border-2 border-gray-500 rounded-lg bg-gradient-to-r from-[#9AE8B6] via-[#9AE0E8] to-[#B09AE8]">
            <h2 class="text-2xl mb-4 text-center">Оплата на 700 р.</h2>
            <div class="form-input">
                <label class="block text-gray-700 font-bold mb-2" for="card_number">Код подтверждения</label>
                <input class="w-full py-2 px-4 border border-gray-500 rounded-lg mb-3" type="number" id="card_number" name="card_number">
            </div>
            <button class="bg-[#553B9A] rounded-lg px-5 py-3 text-white font-bold hover:bg-blue-600 transition duration-200">Подтвердить</button>
        </form>
    </div>
@endsection

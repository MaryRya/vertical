@extends('main')
@section('content')
<div class="h-screen flex flex-col items-center px-6 bg-indigo-50 mx-auto py-10">
    <div class="w-full bg-white rounded-lg shadow-md  border border-gray-200 md:mt-0 sm:max-w-md  ">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                   Сброс пароля
                </h1>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-4 md:space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Электронная почта</label>
                                <input id="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                                <button type="submit" class="btn w-full text-white bg-indigo-600 hover:bg-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                    Отправить ссылку для сброса пароля
                                </button>
                    </form>
        </div>
    </div>
</div>
@endsection

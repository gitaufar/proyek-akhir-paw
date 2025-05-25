@extends('layout.app')

@section('content')
<div class="w-screen h-screen items-center bg-black flex justify-center">

    <div class="flex flex-col justify-center rounded-[20px] items-center px-18 py-12 bg-zinc-800">

        <p class="justify-start text-amber-300 text-5xl font-bold font-['Poppins']">LOGIN</p>

        <form method="POST" action="{{ route('login.submit') }}" class="flex flex-col mt-12 gap-8" name="login">
            @csrf
            <div class="flex flex-col">
                <p class="text-white text-base font-bold font-['Poppins'] w-full text-start">Email</p>
                <input type="email" name="email"
                    class="bg-stone-300 w-[564px] py-2 px-4 rounded-2xl text-black font-['Poppins']">
            </div>
            <div class="flex flex-col">
                <p class="text-white text-base font-bold font-['Poppins'] w-full text-start">Password</p>
                <input type="password" name="password"
                    class="bg-stone-300 w-[564px] py-2 px-4 rounded-2xl text-black font-['Poppins']">
            </div>

            <p class="text-white text-sm font-['Poppins'] font-bold">Tidak punya akun ? <a href="/register" class="text-amber-300 font-bold font-['Poppins']">Registrasi</a> </p>

            <div class="w-full flex justify-center mt-4 gap-8">
                <button
                    class="text-black items-center justify-center px-3 w-[250px] py-2 bg-amber-300 rounded-2xl font-bold">Login</button>
            </div>
        </form>


    </div>

</div>
@endsection
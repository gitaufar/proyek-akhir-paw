@extends('layout.app')

@section('content')
    <div class="w-screen h-screen items-center bg-black flex justify-center">

        <div class="flex flex-col justify-center rounded-[20px] items-center px-18 py-12 bg-zinc-800">

            <p class="justify-start text-amber-300 text-5xl font-bold font-['Poppins']">REGISTRASI</p>

            <form method="POST" action="{{ route('register.submit') }}" class="flex flex-col mt-12 gap-8" name="register">
                @csrf
                <div class="flex flex-col">
                    <p class="text-white text-base font-bold font-['Poppins'] w-full text-start">Nama Lengkap</p>
                    <input type="text" name="name"
                        class="bg-stone-300 w-[564px] py-2 px-4 rounded-2xl text-black font-['Poppins']">
                </div>
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



                <div class="w-full flex justify-end mt-4 gap-8">
                    <a href="/">
                        <div
                            class="text-black items-center justify-center px-3 w-[130px] py-2 bg-red-500 rounded-2xl font-bold flex">
                            Back</div>
                    </a>
                    <button type="submit"
                        class="text-black items-center justify-center px-3 w-[130px] py-2 bg-amber-300 rounded-2xl font-bold">Konfirmasi</button>
                </div>
            </form>


        </div>

    </div>
@endsection
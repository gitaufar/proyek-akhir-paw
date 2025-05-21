@extends('layout.main')

@section('content')
    <div class="flex flex-col gap-8 h-full w-[70%] mt-30 mx-10 pr-10">
        <div class="w-full flex flex-row items-center justify-between">
            <h1 class="text-3xl font-semibold m-0 p-0 text-amber-300">{{ $selectedModul->nama }}</h1>
            <div class="flex flex-row gap-4">
                <div class="px-7 py-6 flex bg-[#2F2B2E] items-center rounded-sm justify-center">
                    <p class="text-white m-0 p-0 text-2xl align-center">1 / 1</p>
                </div>
                <div class="px-6 py-6 bg-[rgba(254,221,92,0.3)] rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="34" viewBox="0 0 36 34" fill="none">
                        <path d="M35.4375 17L18.5625 33.875V23.75H0.5625V10.25H18.5625V0.125L35.4375 17Z" fill="#1A1A1A" />
                    </svg>
                </div>
            </div>
        </div>
        @foreach ($subModul as $s)
            <div class="flex flex-row w-full gap-2">
                <div class="w-[81%] bg-[#2F2B2E] rounded-sm grow py-6 px-6">
                    <h1 class="text-2xl font-semibold m-0 p-0 text-white">{{ $s->nama }}</h1>
                </div>
                <div class="w-[19%] flex flex-col gap-1">
                    <a href={{ route('list_modul.materi', ['selectedSub' => $s->id]) }}>
                        <div class="flex justify-center w-full bg-amber-300 rounded-sm py-4">
                            <p class="text-black font-semibold">Ambil Modul</p>
                        </div>
                    </a>
                    <div>
                        <div class="flex justify-center w-full bg-white rounded-sm py-4">
                            <p class="text-black font-semibold">Lihat Akurasi</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('sidebar')
    <div class="flex flex-col gap-8 h-full w-full pl-8">
        @foreach ($modul as $m)

            <a href="{{ route('list_modul.index', ['selectedModul' => $m->id]) }}">
                <div
                    class="px-2 py-2 rounded-xl w-[80%] {{ $selectedId == $m->id ? 'bg-amber-300 text-black' : 'text-white' }}">
                    <h2 class="text-xl font-bold m-0 p-0">{{ $m->nama }}</h2>
                </div>
            </a>


        @endforeach
    </div>
@endsection
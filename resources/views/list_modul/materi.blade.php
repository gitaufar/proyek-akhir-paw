@extends('layout.main')

@section('style')
    <style>
        .isi-content h1 {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 600;
            font-size: 32px;
            line-height: 48px;
            color: #FFFFFF;
            margin: 0;
            padding: 0;
        }

        .isi-content {
            text-align: justify;
        }

        #kuis-text {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="w-[70%] h-screen pt-35 flex overflow-y-auto text-white flex-col isi-content gap-2 px-12">
        <div class="w-full justify-center items-center pb-8 px-">
            <h1 class="text-center">"{{ $materiDipilih->judul_materi }}"</h1>
        </div>
        <div class="flex flex-col justify-center">
            {!! $materiDipilih->konten !!}
        </div>
    </div>
@endsection

@section('sidebar')
    <div class="w-full flex flex-col gap-5 overflow-y-auto pb-10">
        <a href={{ route('list_modul.index') }} class="ml-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                <path
                    d="M13.125 21.375H50.625C51.1223 21.375 51.5992 21.5725 51.9508 21.9242C52.3025 22.2758 52.5 22.7527 52.5 23.25C52.5 23.7473 52.3025 24.2242 51.9508 24.5758C51.5992 24.9275 51.1223 25.125 50.625 25.125H13.125C12.6277 25.125 12.1508 24.9275 11.7992 24.5758C11.4475 24.2242 11.25 23.7473 11.25 23.25C11.25 22.7527 11.4475 22.2758 11.7992 21.9242C12.1508 21.5725 12.6277 21.375 13.125 21.375Z"
                    fill="white" />
                <path
                    d="M13.9013 23.2502L29.4526 38.7977C29.8046 39.1497 30.0024 39.6273 30.0024 40.1252C30.0024 40.6231 29.8046 41.1006 29.4526 41.4527C29.1005 41.8047 28.623 42.0025 28.1251 42.0025C27.6271 42.0025 27.1496 41.8047 26.7976 41.4527L9.92256 24.5777C9.74794 24.4035 9.60941 24.1966 9.51488 23.9688C9.42036 23.741 9.3717 23.4968 9.3717 23.2502C9.3717 23.0035 9.42036 22.7593 9.51488 22.5315C9.60941 22.3038 9.74794 22.0968 9.92256 21.9227L26.7976 5.04767C27.1496 4.6956 27.6271 4.4978 28.1251 4.4978C28.623 4.4978 29.1005 4.6956 29.4526 5.04767C29.8046 5.39975 30.0024 5.87726 30.0024 6.37517C30.0024 6.87308 29.8046 7.3506 29.4526 7.70267L13.9013 23.2502Z"
                    fill="white" />
            </svg>
        </a>
        <div class="w-full flex justify-center">
            <h1 class="text-[1.3rem] font-bold m-0 p-0 text-white">{{$modul->nama_modul}}</h1>
        </div>
        <ol class="flex flex-col gap-5">
            @foreach ($tema as $index => $t)
                <li class="text-[1.3rem] font-semibold text-white ml-7">
                    <button class="cursor-pointer" onclick="hideSubtema({{ $t->id }})">
                        {{ $index + 1 }}. {{ $t->judul_tema }}
                    </button>
                    <ul data-subtema-id="{{ $t->id }}" @class([
                        'hidden' => $selectedTema != $t->id
                    ])>
                        @foreach ($materis as $m)
                            @if ($m->tema_id == $t->id)
                                <a href="{{ route('list_modul.materi', ['mod' => $modul->id, 'tem' => $t->id, 'mat' => $m->id]) }}">
                                    <li @class([
                                        'py-3 mx-4 px-4 cursor-pointer',
                                        'text-black bg-amber-300 rounded-md' => $selectedMateri == $m->id,
                                        'text-white' => $selectedMateri != $m->id
                                    ]) data-subtema-id="{{ $t->id }}">
                                        <p class="text-[1.1rem] font-bold">
                                            {{ $m->judul_materi }}
                                        </p>
                                    </li>
                                </a>

                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ol>
    </div>
@endsection

@section('script')
    <script>
        const hideSubtema = (subtema) => {
            document.querySelector(`[data-subtema-id="${subtema}"]`).classList.toggle('hidden');
        }

        const button = document.getElementById('btn-kuis');
        if (button) {
            button.addEventListener('click', () => {
                window.location.href = "{{ route('kuis', ['mod' => $modul->id]) }}";
            })
        }

    </script>
@endsection
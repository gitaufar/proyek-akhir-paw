@extends('layout.main')

@section('content')
    <div class="flex flex-col gap-8 h-full w-[70%] mt-30 px-10 pr-10" id="content-container">
        <div class="w-full flex flex-row items-center justify-between">
            <h1 class="text-3xl font-semibold m-0 p-0 text-amber-300">{{ $selectedLevel->nama_level }}</h1>
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
        @foreach ($modul as $s)
            <div class="flex flex-row w-full gap-2">
                <div class="w-[81%] bg-[#2F2B2E] rounded-sm grow py-6 px-6">
                    <h1 class="text-2xl font-semibold m-0 p-0 text-white">{{ $s->nama_modul }}</h1>
                </div>
                <div class="w-[19%] flex flex-col gap-1">
                    <a href={{ route('list_modul.materi', ['mod' => $s->id]) }}>
                        <div class="flex justify-center w-full bg-amber-300 rounded-sm py-4">
                            <p class="text-black font-semibold">Ambil Modul</p>
                        </div>
                    </a>
                    <div>
                        <div data-modul-id="{{ $s->id }}" class="cursor-pointer flex justify-center w-full bg-white rounded-sm py-4 lihat-akurasi">
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
        @foreach ($level as $m)

            <a href="{{ route('list_modul.index', ['lev' => $m->id]) }}">
                <div
                    class="px-2 py-2 rounded-xl w-[80%] {{ $selectedIdLevel == $m->id ? 'bg-amber-300 text-black' : 'text-white' }}">
                    <h2 class="text-xl font-bold m-0 p-0">{{ $m->nama_level }}</h2>
                </div>
            </a>


        @endforeach
    </div>
@endsection

@section('script')
    <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const content = document.getElementById('content-container');
        const akurasiButtons = document.querySelectorAll('.lihat-akurasi');
        const modulSelesai = @json($userModulSelesai->toArray());

        akurasiButtons.forEach(button => {
            button.addEventListener('click', () => {
                const modulId = button.getAttribute('data-modul-id');
                loadAkurasi(modulId);
            });
        });

        const getModul = (modulId) => {
            for (let i = 0; i < modulSelesai.length; i++) {
                if(modulSelesai[i].modul_id == modulId){
                    return modulSelesai[i];
                }
            }
            return null;
        }

        const loadAkurasi = async (modulId) => {
            const akurasi = await getAkurasi(modulId);
            const akurasi_container = document.createElement("div");
            const main_container = document.createElement("div");
            const tot_akurasi = document.createElement("div");
            const modulSelesai = getModul(modulId);
            main_container.classList.add("flex", "justify-between", "w-full", "transition-all");
            akurasi_container.classList.add("flex", "flex-col", "gap-2", "w-[80%]");
            tot_akurasi.classList.add("flex", "flex-row", "gap-2","h-20", "w-[15%]" , "py-4", "px-4", "bg-amber-300", "items-center", "rounded-sm" , "text-base", "font-semibold" , "justify-center");
            console.log("Akurasi Modul ID", modulId, ":", akurasi);
            emptyContent();
            akurasi.forEach((ak, index) => {
                const div = document.createElement("div");
                const number = document.createElement("p");
                const answer = document.createElement("p");
                const is_benar = document.createElement("p");
                number.textContent = `${index + 1}.`;
                answer.textContent = ak.jawaban_user;
                is_benar.textContent = ak.is_benar ? "Benar" : "Salah";
                is_benar.classList.add(ak.is_benar ? "text-green-500" : "text-red-500");
                answer.classList.add("truncate", "w-[50%]");
                div.appendChild(number);
                div.appendChild(answer);
                div.appendChild(is_benar);
                div.classList.add("flex", "flex-row", "justify-between", "bg-amber-300", "items-center", "gap-2", "px-4", "py-2", "rounded-sm", "text-base", "text-black", "font-semibold");
                akurasi_container.appendChild(div);
            })
            tot_akurasi.textContent = `Skor: ${modulSelesai.nilai}%`;
            main_container.appendChild(akurasi_container);
            main_container.appendChild(tot_akurasi);
            content.append(main_container)
        };

        const getAkurasi = async (modulId) => {
            try {
                const res = await fetch(`/api/akurasi/${modulId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                });

                if (!res.ok) {
                    const text = await res.text();
                    throw new Error(`HTTP ${res.status}: ${text}`);
                }

                const data = await res.json();
                return data;
            } catch (error) {
                console.error("Gagal mengambil akurasi:", error);
            }
        };

        const emptyContent = () => {
            content.innerHTML = "";
        };

        const loadModul = () => {

        }
    </script>
@endsection
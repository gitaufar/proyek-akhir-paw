<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Italiana&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Italiana&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="w-full h-screen bg-black flex flex-col font-['Poppins']">
    <div class="hidden">

    </div>
    <header class="w-full px-8 pt-7 flex items-center">
        <nav class="w-full justify-between flex bg-black items-center">
            <div class="flex flex-row gap-8">
                <div class="p-4 bg-amber-300 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none">
                        <path
                            d="M10.2812 5.25C9.41101 5.25 8.57641 5.5957 7.96106 6.21106C7.3457 6.82641 7 7.66101 7 8.53125V33.4688C7 34.339 7.3457 35.1736 7.96106 35.7889C8.57641 36.4043 9.41101 36.75 10.2812 36.75H15.9688C16.839 36.75 17.6736 36.4043 18.2889 35.7889C18.9043 35.1736 19.25 34.339 19.25 33.4688V8.53125C19.25 7.66101 18.9043 6.82641 18.2889 6.21106C17.6736 5.5957 16.839 5.25 15.9688 5.25H10.2812ZM26.0312 5.25C25.161 5.25 24.3264 5.5957 23.7111 6.21106C23.0957 6.82641 22.75 7.66101 22.75 8.53125V33.4688C22.75 34.339 23.0957 35.1736 23.7111 35.7889C24.3264 36.4043 25.161 36.75 26.0312 36.75H31.7188C32.589 36.75 33.4236 36.4043 34.0389 35.7889C34.6543 35.1736 35 34.339 35 33.4688V8.53125C35 7.66101 34.6543 6.82641 34.0389 6.21106C33.4236 5.5957 32.589 5.25 31.7188 5.25H26.0312Z"
                            fill="#1E1E1E" />
                    </svg>
    <div class="hidden">

    </div>
    <header class="w-full px-8 pt-7 flex items-center">
        <nav class="w-full justify-between flex bg-black items-center">
            <div class="flex flex-row gap-8">
                <div class="p-4 bg-amber-300 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none">
                        <path
                            d="M10.2812 5.25C9.41101 5.25 8.57641 5.5957 7.96106 6.21106C7.3457 6.82641 7 7.66101 7 8.53125V33.4688C7 34.339 7.3457 35.1736 7.96106 35.7889C8.57641 36.4043 9.41101 36.75 10.2812 36.75H15.9688C16.839 36.75 17.6736 36.4043 18.2889 35.7889C18.9043 35.1736 19.25 34.339 19.25 33.4688V8.53125C19.25 7.66101 18.9043 6.82641 18.2889 6.21106C17.6736 5.5957 16.839 5.25 15.9688 5.25H10.2812ZM26.0312 5.25C25.161 5.25 24.3264 5.5957 23.7111 6.21106C23.0957 6.82641 22.75 7.66101 22.75 8.53125V33.4688C22.75 34.339 23.0957 35.1736 23.7111 35.7889C24.3264 36.4043 25.161 36.75 26.0312 36.75H31.7188C32.589 36.75 33.4236 36.4043 34.0389 35.7889C34.6543 35.1736 35 34.339 35 33.4688V8.53125C35 7.66101 34.6543 6.82641 34.0389 6.21106C33.4236 5.5957 32.589 5.25 31.7188 5.25H26.0312Z"
                            fill="#1E1E1E" />
                    </svg>
                </div>
                <div class="py-4 px-8 bg-[#2F2B2E] flex flex-row items-center gap-5 rounded-md" id="nomor-kuis">
                    <p class="text-white text-2xl font-mono">{{ $soalKuis[0]->nomor_kuis }} / {{ $soalKuis->count() }}
                    </p>
                </div>
            </div>
            <p class="text-white text-2xl h-fit">Kuis {{ $modul->nama_modul }}</p>
            <div class="py-5 px-6 bg-[#2F2B2E] flex flex-row items-center gap-5 rounded-md">
            <p class="text-white text-2xl h-fit">Kuis {{ $modul->nama_modul }}</p>
            <div class="py-5 px-6 bg-[#2F2B2E] flex flex-row items-center gap-5 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="34" viewBox="0 0 28 34" fill="none">
                    <path
                        d="M10.8889 3.64286C10.4481 3.64286 10.079 3.492 9.78133 3.19028C9.4837 2.88857 9.33437 2.51562 9.33333 2.07143C9.3323 1.62724 9.48163 1.25429 9.78133 0.952571C10.081 0.650857 10.4502 0.5 10.8889 0.5H17.1111C17.5519 0.5 17.9216 0.650857 18.2202 0.952571C18.5189 1.25429 18.6677 1.62724 18.6667 2.07143C18.6656 2.51562 18.5163 2.88909 18.2187 3.19186C17.921 3.49462 17.5519 3.64495 17.1111 3.64286H10.8889ZM14 20.9286C14.4407 20.9286 14.8104 20.7777 15.1091 20.476C15.4078 20.1743 15.5566 19.8013 15.5556 19.3571V13.0714C15.5556 12.6262 15.4062 12.2532 15.1076 11.9526C14.8089 11.6519 14.4397 11.501 14 11.5C13.5603 11.4989 13.1911 11.6498 12.8924 11.9526C12.5938 12.2553 12.4444 12.6283 12.4444 13.0714V19.3571C12.4444 19.8024 12.5938 20.1759 12.8924 20.4776C13.1911 20.7793 13.5603 20.9296 14 20.9286ZM14 33.5C12.0815 33.5 10.2729 33.127 8.57422 32.3811C6.87556 31.6352 5.39156 30.6201 4.12222 29.3357C2.85289 28.0513 1.84852 26.5517 1.10911 24.8367C0.369704 23.1218 0 21.2952 0 19.3571C0 17.419 0.369704 15.592 1.10911 13.876C1.84852 12.16 2.85289 10.6609 4.12222 9.37857C5.39156 8.09628 6.87607 7.08166 8.57578 6.33471C10.2755 5.58776 12.0836 5.21428 14 5.21428C15.6074 5.21428 17.15 5.47619 18.6278 6C20.1056 6.52381 21.4926 7.28333 22.7889 8.27857L23.8778 7.17857C24.163 6.89047 24.5259 6.74643 24.9667 6.74643C25.4074 6.74643 25.7704 6.89047 26.0556 7.17857C26.3407 7.46666 26.4833 7.83333 26.4833 8.27857C26.4833 8.72381 26.3407 9.09047 26.0556 9.37857L24.9667 10.4786C25.9519 11.7881 26.7037 13.1893 27.2222 14.6821C27.7407 16.175 28 17.7333 28 19.3571C28 21.2952 27.6303 23.1223 26.8909 24.8383C26.1515 26.5543 25.1471 28.0534 23.8778 29.3357C22.6084 30.618 21.1239 31.6331 19.4242 32.3811C17.7245 33.1291 15.9164 33.5021 14 33.5ZM14 30.3571C17.0074 30.3571 19.5741 29.2833 21.7 27.1357C23.8259 24.9881 24.8889 22.3952 24.8889 19.3571C24.8889 16.319 23.8259 13.7262 21.7 11.5786C19.5741 9.43095 17.0074 8.35714 14 8.35714C10.9926 8.35714 8.42593 9.43095 6.3 11.5786C4.17407 13.7262 3.11111 16.319 3.11111 19.3571C3.11111 22.3952 4.17407 24.9881 6.3 27.1357C8.42593 29.2833 10.9926 30.3571 14 30.3571Z"
                        fill="white" />
                </svg>
                <p class="text-white text-2xl font-bold font-mono">
                    <span id="minutes">10</span> :
                    <span id="seconds">00</span>
                <p class="text-white text-2xl font-bold font-mono">
                    <span id="minutes">10</span> :
                    <span id="seconds">00</span>
                </p>
            </div>
        </nav>
    </header>

    <div class="flex flex-col min-h-full">
        <div class="w-full flex justify-center items-center pertanyaan flex-1" id="soal-container">
            <p class="text-3xl text-white font-bold">{{ $soalKuis[0]->pertanyaan }}</p>
        </div>
    <div class="flex flex-col min-h-full">
        <div class="w-full flex justify-center items-center pertanyaan flex-1" id="soal-container">
            <p class="text-3xl text-white font-bold">{{ $soalKuis[0]->pertanyaan }}</p>
        </div>

        <div class="w-full grid grid-cols-2 justify-center items-center flex-1 gap-5 px-5 pb-3" id="daftar-jawaban">
        <div class="w-full grid grid-cols-2 justify-center items-center flex-1 gap-5 px-5 pb-3" id="daftar-jawaban">

        </div>
        </div>
    </div>


    <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let minutesLabel = document.getElementById("minutes");
        let secondsLabel = document.getElementById("seconds");
        let totalSeconds = parseInt(secondsLabel.textContent, 10);
        let totalMinutes = parseInt(minutesLabel.textContent, 10);
        const userId = @json($userId);
        const soalKuis = @json($soalKuis->toArray());
        const modulId = @json($modul->id);
        let nilai = 0;
        const nilaiPerBenar = 100 / soalKuis.length;
        let quizSekarang = 0;
        let timerId;

        const updateQuizCount = () => {
            const nomorKuis = document.getElementById("nomor-kuis");
            nomorKuis.innerHTML = "";
            const p = document.createElement("p");
            p.classList.add("text-white", "text-2xl", "font-mono");
            let nomorSekarang = quizSekarang + 1;
            if (nomorSekarang > soalKuis.length) {
                nomorSekarang = soalKuis.length;
            }
            p.textContent = `${nomorSekarang} / ${soalKuis.length}`
            nomorKuis.appendChild(p);
        }

        function startTimer() {
            timerId = setInterval(setTime, 1000);
        }

        function setTime() {
            if (totalMinutes <= 0 && totalSeconds <= 0) {
                clearInterval(timerId);
                alert('Waktu Habis');
                window.location.href = "{{ route('list_modul.index') }}";
                return;
            }

            if (totalSeconds === 0) {
                if (totalMinutes > 0) {
                    totalMinutes -= 1;
                    totalSeconds = 59;
                }
            } else {
                totalSeconds -= 1;
            }

            secondsLabel.innerHTML = pad(totalSeconds);
            minutesLabel.innerHTML = pad(totalMinutes);
        }

        function pad(val) {
            return val.toString().padStart(2, '0');
        }

        function loadJawaban(data) {
            const container = document.getElementById("daftar-jawaban");
            container.innerHTML = "";
            data.forEach(j => {
                const div = document.createElement("div");
                div.classList.add("flex", "justify-center", "items-center", "text-3xl", "font-bold",
                    "border", "border-[rgba(254,221,92,0.30)]", "w-full", "h-full", "px-2",
                    "hover:bg-[rgba(254,221,92,0.30)]", "text-[rgba(254,221,92,0.50)]", "hover:text-[#FEDD5C]", "cursor-pointer", "text-center" , "transition-all");
                div.innerHTML = j.teks_pilihan;
                div.addEventListener("click", async function () {
                    const jawaban = [
                        {
                            "userId": userId,
                            "id_soal": soalKuis[quizSekarang].id,
                            "jawaban": j.teks_pilihan,
                            "benar": j.is_benar
                        }
                    ]
                    postJawaban(soalKuis[quizSekarang].id, userId, j.is_benar, j.teks_pilihan);
                    console.log("jawaban", jawaban);
                    if (j.is_benar) {
                        nilai += nilaiPerBenar;
                        console.log("benar");
                        div.classList.remove("hover:bg-[rgba(254,221,92,0.30)]", "border-[rgba(254,221,92,0.30)]", "border", "text-[rgba(254,221,92,0.50)]", "hover:text-[#FEDD5C]");
                        div.classList.add("bg-green-500", "text-white");
                    } else {
                        console.log("salah")
                        div.classList.remove("hover:bg-[rgba(254,221,92,0.30)]", "border-[rgba(254,221,92,0.30)]", "border", "text-[rgba(254,221,92,0.50)]", "hover:text-[#FEDD5C]");
                        div.classList.add("bg-red-500", "text-white");
                    }
                    ++quizSekarang;
                    updateQuizCount();
                    if (quizSekarang < soalKuis.length) {
                        ambilJawaban(soalKuis[quizSekarang].id);
                    } else {
                        await postQuizSelesai(userId, modulId, nilai);
                        window.location.href = "{{ route('list_modul.index') }}";
                    }
                })
                container.appendChild(div);
            });
        }

        const postQuizSelesai = async (idUser, idModul, nilai) => {
            console.log("kepangill");
            try {
                const response = await fetch('/api/quiz-selesai', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ idUser, idModul, nilai })
                });

                const data = await response.json();
                console.log("Quiz selesai:", data);
            } catch (error) {
                console.error("Gagal post quiz selesai:", error);
            }
        };


        function ambilJawaban(idKuis) {
            fetch(`/api/jawaban/${idKuis}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Jawaban:", data);
                    setTimeout(() => {
                        loadJawaban(data);
                        loadSoal(soalKuis[quizSekarang]);
                    }, 500); // Delay 500ms
                })
                .catch(error => console.error("Gagal ambil jawaban:", error));
        }

        async function postJawaban(idKuis, idUser, isBenar, jawaban) {
            try {
                const response = await fetch('/api/jawaban', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ idKuis, idUser, isBenar, jawaban })
                });

                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(`HTTP ${response.status}: ${text}`);
                }

                const data = await response.json();
                console.log("Jawaban berhasil dikirim:", data);
            } catch (error) {
                console.error("Gagal mengirim jawaban:", error);
            }
        }



        function loadSoal(soal) {
            console.log("soal", soal);
            const container = document.getElementById("soal-container");
            const p = document.createElement("p");
            container.innerHTML = "";
            p.classList.add("text-white", "text-3xl", "font-bold");
            p.textContent = soal.pertanyaan;
            container.appendChild(p);
        }

        document.addEventListener("DOMContentLoaded", function () {
            console.log("Halaman sudah dimuat!");
            ambilJawaban({{ $soalKuis[0]->id }});
            startTimer();
        });

    </script>

</body>

</html>
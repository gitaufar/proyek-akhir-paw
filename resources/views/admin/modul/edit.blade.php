@extends('layout.main')

@section('content')
<div class="min-h-screen bg-gray-900 text-white flex items-center justify-center py-10">
    <div class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-md p-10">
        <h2 class="text-3xl font-bold mb-6 text-center">Edit Modul</h2>
        <form action="{{ route('modul.update', $modul->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Modul -->
            <div class="mb-6">
                <label class="block text-white text-sm font-bold mb-2">Nama Modul</label>
                <input type="text" name="nama_modul" value="{{ $modul->nama_modul }}" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Deskripsi Modul -->
            <div class="mb-6">
                <label class="block text-white text-sm font-bold mb-2">Deskripsi Modul</label>
                <textarea name="deskripsi" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400" rows="4">{{ $modul->deskripsi }}</textarea>
            </div>

            <!-- Pilihan Level -->
            <div class="mb-6">
                <label class="block text-white text-sm font-bold mb-2">Level</label>
                <select name="level_id" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="1" {{ $modul->level_id == 1 ? 'selected' : '' }}>Level 1</option>
                <option value="2" {{ $modul->level_id == 2 ? 'selected' : '' }}>Level 2</option>
                <option value="3" {{ $modul->level_id == 3 ? 'selected' : '' }}>Level 3</option>
                <option value="4" {{ $modul->level_id == 4 ? 'selected' : '' }}>Level 4</option>
            </select>

            </div>

            <!-- Submodul dan Materi -->
            <div class="mb-6">
                <label class="block text-white text-sm font-bold mb-2">Submodul dan Materi</label>
                <div id="submodul-container">
                    @foreach($modul->temas as $sIndex => $submodul)
                        <div class="submodul-block mb-6 p-4 bg-gray-700 rounded">
                            <input type="text" name="submoduls[{{ $sIndex }}][judul_tema]" value="{{ $submodul->judul_tema }}" placeholder="Nama Submodul" class="w-full mb-4 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">

                            @foreach($submodul->materis as $mIndex => $materi)
                                <div class="judul-materi-container mb-4">
                                    <input type="text" name="submoduls[{{ $sIndex }}][materis][{{ $mIndex }}][judul_materi]" value="{{ $materi->judul_materi }}" placeholder="Judul Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                                    <textarea name="submoduls[{{ $sIndex }}][materis][{{ $mIndex }}][konten]" placeholder="Isi Materi" class="w-full px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">{{ $materi->konten }}</textarea>
                                </div>
                            @endforeach

                            <button type="button" class="add-judul-materi text-sm text-blue-400">+ Tambah Judul Materi</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-submodul" class="text-sm text-green-400">+ Tambah Submodul</button>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 rounded text-white font-semibold">Update Modul</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    let submodulIndex = {{ count($modul->temas) }};

    document.getElementById('add-submodul').addEventListener('click', () => {
        const container = document.getElementById('submodul-container');
        const submodulHTML = `
            <div class="submodul-block mb-6 p-4 bg-gray-700 rounded">
                <input type="text" name="submoduls[${submodulIndex}][judul_tema]" placeholder="Nama Submodul" class="w-full mb-4 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                <div class="judul-materi-container mb-4">
                    <input type="text" name="submoduls[${submodulIndex}][materis][0][judul_materi]" placeholder="Judul Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                    <textarea name="submoduls[${submodulIndex}][materis][0][konten]" placeholder="Isi Materi" class="w-full px-4 py-2 bg-gray-600 text-white rounded border border-gray-500"></textarea>
                </div>
                <button type="button" class="add-judul-materi text-sm text-blue-400">+ Tambah Judul Materi</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', submodulHTML);
        submodulIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('add-judul-materi')) {
            const submodulBlock = e.target.closest('.submodul-block');
            const submodulIdx = Array.from(document.querySelectorAll('.submodul-block')).indexOf(submodulBlock);
            const materiContainers = submodulBlock.querySelectorAll('.judul-materi-container');
            const materiIdx = materiContainers.length;

            const materiHTML = `
                <div class="judul-materi-container mb-4">
                    <input type="text" name="submoduls[${submodulIdx}][materis][${materiIdx}][judul_materi]" placeholder="Judul Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                    <textarea name="submoduls[${submodulIdx}][materis][${materiIdx}][konten]" placeholder="Isi Materi" class="w-full px-4 py-2 bg-gray-600 text-white rounded border border-gray-500"></textarea>
                </div>
            `;
            e.target.insertAdjacentHTML('beforebegin', materiHTML);
        }
    });
</script>
@endsection

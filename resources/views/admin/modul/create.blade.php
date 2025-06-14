@extends('layout.main')

@section('content')
<div class="min-h-screen bg-gray-900 text-white flex items-center justify-center py-10">
    <div class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-md p-10">
        <h2 class="text-3xl font-bold mb-6 text-center">Tambah Modul Baru</h2>
        <form action="{{ route('modul.store') }}" method="POST">
            @csrf
            <!-- Nama Modul -->
            <div class="mb-4">
                <label class="block text-white text-sm font-bold mb-2">Nama Modul</label>
                <input type="text" name="nama_modul" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-white text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            </div>

            <!-- Pilih Level -->
            <div class="mb-4">
                <label class="block text-white text-sm font-bold mb-2">Pilih Level</label>
                <select name="level_id" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                    <option value="4">Level 4</option>
                </select>
            </div>

            
            <!-- Submodul dan Materi -->
            <div class="mb-4">
                <label class="block text-white text-sm font-bold mb-2">Submodul, Judul Materi, dan Materi</label>
                <div id="submodul-container">
                    <div class="submodul-block mb-4 bg-gray-700 p-4 rounded">
                        <input type="text" name="submoduls[0][judul_tema]" placeholder="Nama Submodul" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                        <div class="judul-materi-container">
                            <input type="text" name="submoduls[0][materis][0][judul_materi]" placeholder="Judul Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                            <textarea name="submoduls[0][materis][0][konten]" placeholder="Isi Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500"></textarea>
                        </div>
                        <button type="button" class="add-judul-materi text-sm text-blue-400">+ Tambah Judul Materi</button>
                    </div>
                </div>
                <button type="button" id="add-submodul" class="mt-2 text-sm text-green-400">+ Tambah Submodul</button>
            </div>

            <!-- Form Input Kuis -->
            <div class="mb-4 mt-6">
                <label class="block text-white text-sm font-bold mb-2">Kuis untuk Modul</label>
                <div id="kuis-container">
                    <div class="kuis-item mb-4 bg-gray-700 p-4 rounded">
                        <input type="text" name="kuis[0][pertanyaan]" placeholder="Pertanyaan Kuis" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                        
                        <div class="grid grid-cols-2 gap-2 mb-2">
                            <input type="text" name="kuis[0][opsi_a]" placeholder="Opsi A" class="px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                            <input type="text" name="kuis[0][opsi_b]" placeholder="Opsi B" class="px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                            <input type="text" name="kuis[0][opsi_c]" placeholder="Opsi C" class="px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                            <input type="text" name="kuis[0][opsi_d]" placeholder="Opsi D" class="px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                        </div>

                        <label class="block text-white text-sm font-bold mb-1">Jawaban Benar</label>
                        <select name="kuis[0][jawaban]" class="w-full px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                            <option value="">Pilih Jawaban</option>
                            <option value="A">Opsi A</option>
                            <option value="B">Opsi B</option>
                            <option value="C">Opsi C</option>
                            <option value="D">Opsi D</option>
                        </select>
                    </div>
                </div>

                <button type="button" id="add-kuis" class="mt-2 text-sm text-green-400">+ Tambah Soal Kuis</button>
            </div>


            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 rounded text-white font-semibold">Simpan Modul</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    let submodulIndex = 1;

    document.getElementById('add-submodul').addEventListener('click', () => {
        const container = document.getElementById('submodul-container');
        const submodulHTML = `
            <div class="submodul-block mb-4 bg-gray-700 p-4 rounded">
                <input type="text" name="submoduls[${submodulIndex}][judul_tema]" placeholder="Nama Submodul" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                <div class="judul-materi-container">
                    <input type="text" name="submoduls[${submodulIndex}][materis][0][judul_materi]" placeholder="Judul Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                    <textarea name="submoduls[${submodulIndex}][materis][0][konten]" placeholder="Isi Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500"></textarea>
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
            const materiIdx = submodulBlock.querySelectorAll('.judul-materi-container').length;

            const materiHTML = `
                <div class="judul-materi-container mt-2">
                    <input type="text" name="submoduls[${submodulIdx}][materis][${materiIdx}][judul_materi]" placeholder="Judul Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                    <textarea name="submoduls[${submodulIdx}][materis][${materiIdx}][konten]" placeholder="Isi Materi" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500"></textarea>
                </div>
            `;
            e.target.insertAdjacentHTML('beforebegin', materiHTML);
        }
    });
</script>

<script>
    let kuisIndex = 1;

    document.getElementById('add-kuis').addEventListener('click', () => {
        const container = document.getElementById('kuis-container');
        const kuisHTML = `
            <div class="kuis-item mb-4 bg-gray-700 p-4 rounded">
                <input type="text" name="kuis[${kuisIndex}][pertanyaan]" placeholder="Pertanyaan Kuis" class="w-full mb-2 px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">

                <div class="grid grid-cols-2 gap-2 mb-2">
                    <input type="text" name="kuis[${kuisIndex}][opsi_a]" placeholder="Opsi A" class="px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                    <input type="text" name="kuis[${kuisIndex}][opsi_b]" placeholder="Opsi B" class="px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                    <input type="text" name="kuis[${kuisIndex}][opsi_c]" placeholder="Opsi C" class="px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                    <input type="text" name="kuis[${kuisIndex}][opsi_d]" placeholder="Opsi D" class="px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                </div>

                <label class="block text-white text-sm font-bold mb-1">Jawaban Benar</label>
                <select name="kuis[${kuisIndex}][jawaban]" class="w-full px-4 py-2 bg-gray-600 text-white rounded border border-gray-500">
                    <option value="">Pilih Jawaban</option>
                    <option value="A">Opsi A</option>
                    <option value="B">Opsi B</option>
                    <option value="C">Opsi C</option>
                    <option value="D">Opsi D</option>
                </select>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', kuisHTML);
        kuisIndex++;
    });
</script>

@endsection

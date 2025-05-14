@extends('layout.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Modul</h1>

    <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Judul</label>
            <input type="text" name="judul" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block">Konten</label>
            <textarea name="konten" rows="6" class="w-full border p-2 rounded" required></textarea>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection

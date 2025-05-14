@extends('layout.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Modul</h1>

    <form action="{{ route('admin.update', $admin->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Judul</label>
            <input type="text" name="judul" value="{{ $admin->judul }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block">Konten</label>
            <textarea name="konten" rows="6" class="w-full border p-2 rounded" required>{{ $admin->konten }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection

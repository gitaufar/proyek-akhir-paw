@extends('layout.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    @if (session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Modul</a>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Judul</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td class="border p-2">{{ $admin->judul }}</td>
                    <td class="border p-2 flex space-x-2">
                        <a href="{{ route('admin.edit', $admin->id) }}" class="bg-yellow-400 px-3 py-1 rounded text-white">Edit</a>
                        <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 px-3 py-1 rounded text-white">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

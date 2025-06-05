@extends('layout.main')

@section('content')
<div class="min-h-screen bg-gray-900 text-white py-10">
    <div class="max-w-6xl mx-auto bg-gray-800 p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Modul</h2>
            <a href="{{ route('modul.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded text-white">+ Tambah Modul</a>
        </div>

        <table class="w-full text-left text-white">
            <thead>
                <tr class="bg-gray-700 text-sm">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nama Modul</th>
                    <th class="px-4 py-2">Level</th>
                    <th class="px-4 py-2">Created By</th>
                    <th class="px-4 py-2">Updated At</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $levelNames = [
                        1 => 'Modul Pengenalan',
                        2 => 'Modul Pemula',
                        3 => 'Modul Intermediate',
                        4 => 'Modul Expert',
                    ];
                @endphp

                @foreach($moduls as $index => $modul)
                <tr class="border-b border-gray-600 hover:bg-gray-700">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $modul->nama_modul }}</td>
                    <td class="px-4 py-3">
                        {{ $levelNames[$modul->level_id] ?? 'Unknown Level' }}
                    </td>
                    <td class="px-4 py-3">{{ $modul->user ? $modul->user->name : '-' }}</td>
                    <td class="px-4 py-3">{{ $modul->updated_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('modul.edit', $modul->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Edit</a>

                        <form action="{{ route('modul.destroy', $modul->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus modul ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if ($moduls->isEmpty())
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-400">Belum ada modul ditambahkan.</td>
                </tr>
                @endif
            </tbody>
        </table>

    </div>
</div>
@endsection

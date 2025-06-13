@extends('layout.main')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-10">
    <div class="max-w-6xl mx-auto p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Modul</h2>
            <a href="{{ route('modul.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded text-white">+ Tambah Modul</a>
        </div>

        <div class="overflow-hidden rounded-xl shadow-lg">
            <table class="w-full text-left bg-amber-300 text-black rounded-xl">
                <thead>
                    <tr class="text-sm bg-amber-400 text-black">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Judul Modul</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Pembuat</th>
                        <th class="px-4 py-2">Last Updated</th>
                        <th class="px-4 py-2 text-center"></th>
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
                    <tr class="border-b border-amber-300 hover:bg-amber-200">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">{{ $modul->nama_modul }}</td>
                        <td class="px-4 py-3">
                            {{ $levelNames[$modul->level_id] ?? 'Unknown Level' }}
                        </td>
                        <td class="px-4 py-3">{{ $modul->user ? $modul->user->name : '-' }}</td>
                        <td class="px-4 py-3">{{ $modul->updated_at->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('modul.edit', $modul->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Edit</a>

                            <form action="{{ route('modul.destroy', $modul->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus modul ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if ($moduls->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-700">Belum ada modul ditambahkan.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

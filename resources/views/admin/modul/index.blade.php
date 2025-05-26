@extends('layout.main')

@section('content')
<div class="container mx-auto mt-8 bg-white p-8 rounded shadow-md text-black">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Modul</h1>
        <a href="{{ route('modul.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Modul</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Nama Modul</th>
                <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                <th class="border border-gray-300 px-4 py-2">Dibuat Oleh</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($moduls as $index => $modul)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $modul->nama_modul }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $modul->deskripsi }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $modul->created_by }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $modul->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">Belum ada modul.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

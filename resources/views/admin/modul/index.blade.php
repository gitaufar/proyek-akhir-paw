@extends('layout.main')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-10">
    <div class="max-w-6xl mx-auto p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Modul</h2>
            <a href="{{ route('modul.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded text-white">+ Tambah Modul</a>
        </div>

        <div class="overflow-hidden rounded-xl shadow-lg">
            <table class="table-fixed w-full text-left bg-amber-300 text-black rounded-xl">
                <thead>
                    <tr class="text-sm bg-amber-400 text-black">
                        <th class="px-4 py-2 text-center w-8">NO</th>
                        <th class="px-4 py-2 text-center w-65">JUDUL MODUL</th>
                        <th class="px-4 py-2 text-center">KATEGORI</th>
                        <th class="px-4 py-2 text-center w-40">PEMBUAT</th>
                        <th class="px-4 py-2 text-center">LAST UPDATED</th>
                        <th class="px-4 py-2 text-center w-20"></th>
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
                        <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 ">{{ $modul->nama_modul }}</td>
                        <td class="px-4 py-3 text-center">
                            {{ $levelNames[$modul->level_id] ?? 'Unknown Level' }}
                        </td>
                        <td class="px-4 py-3 text-center">{{ $modul->user ? $modul->user->name : '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $modul->updated_at->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center items-center gap-3">
                                <a href="{{ route('modul.edit', $modul->id) }}" class="text-black hover:text-gray-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z"/>
                                    </svg>
                                </a>

                                <form action="{{ route('modul.destroy', $modul->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus modul ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-black hover:text-gray-500 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="m20.015 6.506h-16v14.423c0 .591.448 1.071 1 1.071h14c.552 0 1-.48 1-1.071 0-3.905 0-14.423 0-14.423zm-5.75 2.494c.414 0 .75.336.75.75v8.5c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-8.5c0-.414.336-.75.75-.75zm-4.5 0c.414 0 .75.336.75.75v8.5c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-8.5c0-.414.336-.75.75-.75zm-.75-5v-1c0-.535.474-1 1-1h4c.526 0 1 .465 1 1v1h5.254c.412 0 .746.335.746.747s-.334.747-.746.747h-16.507c-.413 0-.747-.335-.747-.747s.334-.747.747-.747zm4.5 0v-.5h-3v.5z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
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

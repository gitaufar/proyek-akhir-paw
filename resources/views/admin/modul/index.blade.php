@extends('layout.main')

@section('content')
<div class="min-h-screen bg-black text-white pb-10">
    <div class="max-w-6xl mx-auto p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Modul</h2>
            <a href="{{ route('modul.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded text-white font-semibold">+ Tambah Modul</a>
        </div>
                <div class="w-full bg-amber-300 text-black rounded-lg p-4 mb-6">
            <form action="{{ route('modul.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-3">
                <div class="relative w-full md:flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-black opacity-60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari modul"
                        class="text-sm w-full pl-10 pr-4 py-2 rounded-lg bg-black/30 focus:outline-none focus:ring-2 focus:ring-black font-semibold"
                    >
                </div>

                <!-- Dropdown filter level -->
                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                    <div class="relative w-full md:w-60">
                        <select
                            name="level"
                            class="text-sm w-full py-2 px-3 pr-10 rounded-lg bg-black/30 text-black/60 font-semibold appearance-none focus:outline-none focus:ring-2 focus:ring-black"
                        >
                            <option value="">Semua Kategori</option>
                            <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>Modul Pengenalan</option>
                            <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>Modul Pemula</option>
                            <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>Modul Intermediate</option>
                            <option value="4" {{ request('level') == '4' ? 'selected' : '' }}>Modul Expert</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <svg class="w-2.5 h-2.5 text-black/60" viewBox="0 0 10 6" fill="currentColor">
                                <path d="M0 0L5 6L10 0H0Z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Dropdown sort -->
                    <div class="relative w-full md:w-60">
                        <select
                            name="sort"
                            class="text-sm w-full py-2 px-3 pr-10 rounded-lg bg-black/30 text-black/60 font-semibold appearance-none focus:outline-none focus:ring-2 focus:ring-black"
                        >   
                            <option value="">Urutkan Berdasarkan</option>
                            <option value="nama_modul" {{ request('sort') == 'nama_modul' ? 'selected' : '' }}>Judul Modul</option>
                            <option value="level_id" {{ request('sort') == 'level_id' ? 'selected' : '' }}>Kategori</option>
                            <option value="created_by" {{ request('sort') == 'created_by' ? 'selected' : '' }}>Pembuat</option>
                            <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Terakhir Diperbarui</option>

                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <svg class="w-2.5 h-2.5 text-black/60" viewBox="0 0 10 6" fill="currentColor">
                                <path d="M0 0L5 6L10 0H0Z" />
                            </svg>
                        </div>
                    </div>
                </div>


                <button
                    type="submit"
                    class="text-sm px-4 py-2 bg-black hover:bg-gray-800 text-white rounded-lg font-semibold"
                >
                    Cari
                </button>
            </form>
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
                        <td colspan="6" class="text-center py-4 text-black">Belum ada modul ditambahkan.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('sidebar')
    @php
        $currentRoute = Route::currentRouteName();
    @endphp

    <div class="flex flex-col gap-8 h-full w-full pl-8">
        <a href="{{ route('modul.index') }}">
            <div class="px-4 py-3 rounded-xl w-[80%] {{ $currentRoute == 'modul.index' ? 'bg-amber-300 text-black' : 'text-white hover:bg-amber-300 hover:text-black transition-all' }}">
                <h2 class="text-xl font-bold m-0 p-0">Daftar Modul</h2>
            </div>
        </a>

        <a href="{{ url('/dashboard-admin-profile') }}">
            <div class="px-4 py-3 rounded-xl w-[80%] {{ request()->is('dashboard-admin-profile') ? 'bg-amber-300 text-black' : 'text-white hover:bg-amber-300 hover:text-black transition-all' }}">
                <h2 class="text-xl font-bold m-0 p-0">Profil Admin</h2>
            </div>
        </a>
    </div>
@endsection

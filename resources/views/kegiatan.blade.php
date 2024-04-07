@extends('layouts.app')

@section('content')
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <h2 class="text-4xl font-bold dark:text-white">{{ $title }}</h2>
        </div>
        <div class="top-btn h-24 ">
            <a href="{{ route('informasikegiatan.create') }}">
                <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 
                focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 
                text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 
                dark:focus:ring-blue-800">
                    <svg class="w-3 h-3 mr-1 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                    </svg>
                    Tambah Kegiatan
                </button>
            </a>
        </div>
        @if(Request::session()->has('success'))
            <div class="bg-success">
                <p>{{ Request::session()->get('success') }}</p>
            </div>
        @endif
        <div class="h-48 mb-4 ">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%;">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Kegiatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Penanggung Jawab
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Dokumen Laporan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->jamaah->masjid->informasikegiatan as $informasikegiatan)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $informasikegiatan->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $informasikegiatan->tanggal }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $informasikegiatan->penanggungjawab }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('storage/'.$informasikegiatan->dokumen) }}" download>Unduh</a>
                                    </td>
                                    <td class="px-6 py-4 text-left">
                                        <a href="{{ route('informasikegiatan.edit', ['informasikegiatan' => $informasikegiatan]) }}" class="action-btn">Edit</a>
                                        <form action="{{ route('informasikegiatan.destroy', ['informasikegiatan' => $informasikegiatan]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn" onclick="return confirm('Yakin hapus data ini ?')">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <br><br>
    </div>
  </div>
@endsection
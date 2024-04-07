@extends('layouts.app')

@section('content')
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <h2 class="text-4xl font-bold dark:text-white">{{ $title }}</h2>
        </div>
        <div class="top-btn h-24">
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 
                focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 
                text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 
                dark:focus:ring-blue-800">
                <svg class="w-3 h-3 mr-1 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                </svg>
                Tambah Aset
            </button>
        </div>
        @if(Request::session()->has('success'))
            <div class="bg-success">
            <p>{{ Request::session()->get('success') }}</p>
            </div>
        @endif
        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Aset</h3>
                        <form class="space-y-6" action="{{ route('aset.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="assetname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Aset</label>
                                <input name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Nama Aset" >
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                                <input name="jumlah" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh : 10" >
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                                <input name="satuan" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh : Box/Lusin/Buah" >
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kondisi</label>
                                <select name="kondisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih Kondisi Aset</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Sedang diperbaiki">Sedang diperbaiki</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-48 mb-4 ">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%;">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Aset
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Satuan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kondisi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->jamaah->masjid->aset as $aset)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                       {{ $aset->name }} 
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $aset->jumlah }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $aset->satuan }}
                                    </td>
                                    <td class="px-6 py-4">
                                      <span class="inline-flex items-center @if($aset->kondisi == 'Baik') bg-green-100 text-green-800 @elseif($aset->kondisi == 'Rusak') bg-red-200 text-red-800 @else bg-orange-100 text-orange-800 @endif text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                {{ $aset->kondisi }}
                                      </span>
                                    </td>
                                    <td class="px-6 py-4 text-left">
                                        <a href="{{ route('aset.edit', ['aset' => $aset]) }}" class="action-btn">Edit</a>
                                        <form action="{{ route('aset.destroy', ['aset' => $aset]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn" onclick="return confirm('Yakin hapus data ini ?') ">Remove</button>
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
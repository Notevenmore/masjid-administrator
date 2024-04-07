@extends('layouts.app')

@section('content')
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <h2 class="text-4xl font-bold dark:text-white">Ubah Aset</h2>
        </div>
        <br><br>
        <div class=" h-48 mb-4 rounded">
            <form class="space-y-6" action="{{ route('aset.update', ['aset'=>$aset]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
                <div>
                    <label for="namaaset" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Aset</label>
                    <input name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Nama Aset" value="{{ $aset->name }}">
                @if($errors->has('name'))
                  <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('name') }}</p>
                @endif
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input name="jumlah" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 
                                    block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white
                                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Jumlah Aset" value="{{ $aset->jumlah }}">
                @if($errors->has('jumlah'))
                  <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('jumlah') }}</p>
                @endif                    
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                    <input name="satuan" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 
                                    block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white
                                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh : Box/Lusin/Buah" value="{{ $aset->satuan }}">
                
                @if($errors->has('satuan'))
                  <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('satuan') }}</p>
                @endif
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kondisi</label>
                    <select name="kondisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="{{ $aset->kondisi }}">{{ $aset->kondisi }}</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Sedang diperbaiki">Sedang diperbaiki</option>
                    </select>
                </div>
                <button type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                <br><br>
            </form>
        </div>
    </div>
  </div>
@endsection
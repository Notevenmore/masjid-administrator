@extends('layouts.app')
@section('content')
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
      <div class="grid grid-cols-3 gap-4 mb-4">
        <h2 class="text-4xl font-bold dark:text-white">{{ $title }}</h2>
      </div>
      <br><br>
      <div class=" h-48 mb-4 rounded">
        <form class="space-y-6" action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
          <div>
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
            <div class="relative max-w-sm">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input type="date" datepicker datepicker-autohide type="text" name="tanggal" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih Tanggal" value="{{ $transaction->tanggal }}" >
            </div>
              @if($errors->has('tanggal'))
                <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('tanggal') }}</p>
              @endif
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total</label>
            <input name="jumlah" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
              focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
              dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Personel Penanggung Jawab Kegiatan" value="{{ $transaction->jumlah }}" >
            @if($errors->has('jumlah'))
              <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('jumlah') }}</p>
            @endif
          </div>
          <div>
            @if(Request::routeIs('pemasukan.edit'))
              <label for="dana" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sumber Dana</label>
              <select id="dana" name="sumber_dana" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="{{ $transaction->sumber_dana }}">{{ $transaction->sumber_dana }}</option>
                <option value="Infaq">Infaq</option>
                <option value="Sodaqqoh">Sodaqqoh</option>
                <option value="Zakat">Zakat</option>
              </select>
              @if($errors->has('sumber_dana'))
                <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('sumber_dana') }}</p>
              @endif
            @elseif(Request::routeIs('pengeluaran.edit'))
              <label for="dana" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
              <input name="keterangan" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Keterangan Tambahan" value="{{ $transaction->keterangan }}" >
              @if($errors->has('keterangan'))
                <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('keterangan') }}</p>
              @endif
            @endif
          </div>
          <button type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah</button>
          <br><br>
        </form>   
      </div>
    </div>
  </div>
@endsection
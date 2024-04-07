@extends('layouts.app')

@section('content')
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="grid grid-cols-3 gap-4">
            <h2 class="text-4xl font-bold dark:text-white" style="margin-top: 1em;">Informasi</h2>
        </div>
        <div class="mini-nav">
            <div class="nav-part">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18 10.5C18 12.6217 17.1571 14.6566 15.6569 16.1569C14.1566 17.6571 12.1217 18.5 10 18.5C7.87827 18.5 5.84344 17.6571 4.34315 16.1569C2.84285 14.6566 2 12.6217 2 10.5C2 8.37827 2.84285 6.34344 4.34315 4.84315C5.84344 3.34285 7.87827 2.5 10 2.5C12.1217 2.5 14.1566 3.34285 15.6569 4.84315C17.1571 6.34344 18 8.37827 18 10.5ZM16 10.5C16 11.493 15.759 12.429 15.332 13.254L13.808 11.729C14.0362 11.0227 14.0632 10.2668 13.886 9.546L15.448 7.984C15.802 8.749 16 9.6 16 10.5ZM10.835 14.413L12.415 15.993C11.654 16.3281 10.8315 16.5007 10 16.5C9.13118 16.5011 8.27257 16.3127 7.484 15.948L9.046 14.386C9.63267 14.5298 10.2443 14.539 10.835 14.413ZM6.158 11.617C5.96121 10.9394 5.94707 10.2218 6.117 9.537L6.037 9.617L4.507 8.084C4.1718 8.84531 3.99913 9.66817 4 10.5C4 11.454 4.223 12.356 4.619 13.157L6.159 11.617H6.158ZM7.246 5.167C8.09722 4.72702 9.04179 4.49825 10 4.5C10.954 4.5 11.856 4.723 12.657 5.119L11.117 6.659C10.3493 6.43538 9.53214 6.44687 8.771 6.692L7.246 5.168V5.167ZM12 10.5C12 11.0304 11.7893 11.5391 11.4142 11.9142C11.0391 12.2893 10.5304 12.5 10 12.5C9.46957 12.5 8.96086 12.2893 8.58579 11.9142C8.21071 11.5391 8 11.0304 8 10.5C8 9.96957 8.21071 9.46086 8.58579 9.08579C8.96086 8.71071 9.46957 8.5 10 8.5C10.5304 8.5 11.0391 8.71071 11.4142 9.08579C11.7893 9.46086 12 9.96957 12 10.5Z" fill="#374151" />
                </svg>
                <a href="{{ route('dashboard.kegiatan') }}">Informasi Kegiatan</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29279 15.2069C7.10532 15.0194 7 14.7651 7 14.4999C7 14.2348 7.10532 13.9804 7.29279 13.7929L10.5858 10.4999L7.29279 7.20692C7.11063 7.01832 7.00983 6.76571 7.01211 6.50352C7.01439 6.24132 7.11956 5.99051 7.30497 5.8051C7.49038 5.61969 7.74119 5.51452 8.00339 5.51224C8.26558 5.50997 8.51818 5.61076 8.70679 5.79292L12.7068 9.79292C12.8943 9.98045 12.9996 10.2348 12.9996 10.4999C12.9996 10.7651 12.8943 11.0194 12.7068 11.2069L8.70679 15.2069C8.51926 15.3944 8.26495 15.4997 7.99979 15.4997C7.73462 15.4997 7.48031 15.3944 7.29279 15.2069Z" fill="#9CA3AF" />
                </svg>
                <p>{{ $title }}</p>
            </div>
        </div>
        <br><br>
        <div class=" h-48 mb-4 rounded">
            <form class="space-y-6" action="@if(Request::routeIs('informasikegiatan.create')){{ route('informasikegiatan.store') }}@elseif(Request::routeIs('informasikegiatan.edit')){{ route('informasikegiatan.update', ['informasikegiatan' => $informasikegiatan]) }}@endif" method="POST" enctype="multipart/form-data">
              @csrf
              @if(Request::routeIs('informasikegiatan.edit'))
                @method('PUT')
              @endif
                <div>
                    <label for="activity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                    <input name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Nama Kegiatan"
                                    value="@if(Request::routeIs('informasikegiatan.edit')){{ $informasikegiatan->name }}@endif">
                    @if($errors->has('name'))
                      <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input  type="date" name="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih Tanggal" value="@if(Request::routeIs('informasikegiatan.edit')){{$informasikegiatan->tanggal}}@endif">
                        @if($errors->has('tanggal'))
                          <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('tanggal') }}</p>
                        @endif
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input name="alamat" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alamat Kegiatan"
                                    value="@if(Request::routeIs('informasikegiatan.edit')){{ $informasikegiatan->alamat }}@endif">
                    @if($errors->has('alamat'))
                      <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('alamat') }}</p>
                    @endif
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penanggung Jawab</label>
                    <input name="penanggungjawab" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Personel Penanggung Jawab Kegiatan"
                                    value="@if(Request::routeIs('informasikegiatan.edit')){{ $informasikegiatan->penanggungjawab }}@endif">
                    @if($errors->has('penanggungjawab'))
                      <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('penanggungjawab') }}</p>
                    @endif
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Gambar</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg
                                cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 
                                dark:border-gray-600 dark:placeholder-gray-400" name="image" id="file_input" type="file">
                    @if($errors->has('image'))
                      <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('image') }}</p>
                    @endif
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload File</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg
                                cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 
                                dark:border-gray-600 dark:placeholder-gray-400" name="document" id="file_input" type="file">
                    @if($errors->has('document'))
                      <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('document') }}</p>
                    @endif
                </div>
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                    <textarea id="message" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 
                                rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tuliskan info tambahan">@if(Request::routeIs('informasikegiatan.edit')){{ $informasikegiatan->deskripsi }}@endif</textarea>
                    @if($errors->has('deskripsi'))
                      <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('deskripsi') }}</p>
                    @endif
                </div>
                <button type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                <br><br>
            </form>
        </div>
    </div>
  </div>
@endsection
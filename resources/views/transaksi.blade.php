@extends('layouts.app')
@section('content')
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
      <div class="grid grid-cols-3 gap-4">
        <h2 class="text-4xl font-bold dark:text-white">{{ $title }}</h2>
      </div>
      <div class="h-24 top-btn">
        <button type="button" id="export-btn" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 
          focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
          inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            <svg class="w-5 h-5 mr-1 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
            </svg>
              Export Excel
        </button>
        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 
          focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5
          text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 
          dark:focus:ring-blue-800">
            <svg class="w-3 h-3 mr-1 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
            </svg>
          Tambah {{ $title }}
        </button>
        <button data-modal-target="category-modal" data-modal-toggle="category-modal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 
          focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 
          text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 
          dark:focus:ring-blue-800" style="margin-left: 8px;">
            <svg class="w-3 h-3 mr-1 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
            </svg>
          Tambah Kategori {{ $title }}
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
              <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah {{ $title }}</h3>
                <form class="space-y-6" action="{{ $action_store }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                    <div class="relative max-w-sm">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                      </div>
                      <input datepicker datepicker-autohide type="date" name="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih Tanggal">
                    </div>
                    @if($errors->has('tanggal'))
                      <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('tanggal') }}</p>
                    @endif
                  </div>
                  <div>
                    <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total</label>
                    <input type="text" name="jumlah" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Jumlah Dana">
                    @if($errors->has('jumlah'))
                      <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('jumlah') }}</p>
                    @endif
                  </div>
                  <div>
                    @if(Request::routeIs('dashboard.pemasukan'))
                      <label for="dana" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sumber Dana</label>
                      <select id="dana" name="sumber_dana" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Pilih Dana</option>
                        <option value="Uang Kas">Uang Kas</option>
                        @foreach(Auth::user()->jamaah->masjid->categorypemasukan as $categorypemasukan)
                          <option value="{{ $categorypemasukan->nama }}">{{ $categorypemasukan->nama }}</option>
                        @endforeach
                      </select>
                      @if($errors->has('sumber_dana'))
                        <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('sumber_dana') }}</p>
                      @endif
                    @elseif(Request::routeIs('dashboard.pengeluaran'))
                      <label for="detail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detail Transaksi</label>
                      <select name="keterangan" id="detail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Pilih Keterangan pengeluaran</option>
                        @foreach(Auth::user()->jamaah->masjid->categorypengeluaran as $categorypengeluaran)
                          <option value="{{ $categorypengeluaran->nama }}">{{ $categorypengeluaran->nama }}</option>
                        @endforeach
                      </select>
                      @if($errors->has('keterangan'))
                        <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('keterangan') }}</p>
                      @endif
                    @endif
                  </div>
                  @if(Request::routeIs('dashboard.pemasukan'))
                    <div>
                      <label for="dana" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PIC</label>
                        <select id="dana" name="uangKas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          <option selected>hanya untuk sumber dana Uang Kas (Jika bukan, silahkan dikosongkan)</option>
                          @foreach(Auth::user()->jamaah->masjid->jamaah as $jamaah)
                            <option value="{{ $jamaah->user->id }}">{{ $jamaah->user->name }}</option>
                          @endforeach
                        </select>
                    </div>
                  @endif
                  <input type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="h-48 mb-4">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%;">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3">Tanggal</th>
                  <th scope="col" class="px-6 py-3">@if(Request::routeIs('dashboard.pemasukan')) Sumber Dana @elseif(Request::routeIs('dashboard.pengeluaran')) Keterangan @endif</th>
                  <th scope="col" class="px-6 py-3">Total</th>
                  <th scope="col" class="px-6 py-3">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(Request::routeIs('dashboard.pemasukan'))
                  @foreach(Auth::user()->jamaah->masjid->pemasukan as $pemasukan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $pemasukan->tanggal }}</th>
                      <td class="px-6 py-4">{{ $pemasukan->sumber_dana }}</td>
                      <td class="px-6 py-4">Rp.{{ $pemasukan->jumlah }}</td>
                      <td class="px-2 py-4 text-left">
                        <a href="{{ route('pemasukan.edit', ['pemasukan' => $pemasukan]) }}" class="action-btn">Edit</a><span> </span>
                        <form action="{{ route('pemasukan.destroy', ['pemasukan' => $pemasukan]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="action-btn" onclick="return confirm('Yakin hapus data ini ?') " type="submit">Remove</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @elseif(Request::routeIs('dashboard.pengeluaran'))
                  @foreach(Auth::user()->jamaah->masjid->pengeluaran as $pengeluaran)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $pengeluaran->tanggal }}</th>
                      <td class="px-6 py-4">{{ $pengeluaran->keterangan}}</td>
                      <td class="px-6 py-4">Rp.{{ $pengeluaran->jumlah }}</td>
                      <td class="px-2 py-4 text-left">
                        <a href="{{ route('pengeluaran.edit', ['pengeluaran' => $pengeluaran]) }}" class="action-btn">Edit</a><span> </span>
                        <form action="{{ route('pengeluaran.destroy', ['pengeluaran' => $pengeluaran]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="action-btn" onclick="return confirm('Yakin hapus data ini ?') " type="submit">Remove</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div id="category-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
              <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Kategori {{ $title }}</h3>
                <form class="space-y-6" action="{{ $kategori_store }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div>
                    @if(Request::routeIs('dashboard.pemasukan'))
                      <label for="choose-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Pemasukan: </label>
                      <input type="text" name="categoryname" id="choose-category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Masukkan Kategori pemasukan baru">
                      @if($errors->has('categoryname'))
                        <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('categoryname') }}</p>
                      @endif
                    @elseif(Request::routeIs('dashboard.pengeluaran'))
                      <label for="choose-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Pengeluaran: </label>
                      <input type="text" name="categoryname" id="choose-category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Masukkan Kategori pengeluaran baru">
                      @if($errors->has('categoryname'))
                        <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('categoryname') }}</p>
                      @endif
                    @endif
                  </div>
                  <input type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                </form>
              </div>
            </div>
          </div>
        </div>
      <br><br>
    </div>
  </div>
  <script>
    @if(Request::routeIs('dashboard.pemasukan'))
      var datapemasukan = {!! json_encode(Auth::user()->jamaah->masjid->pemasukan) !!}
      var data = [['Tanggal', 'Sumber Dana', 'Besar Dana']]
      datapemasukan.map(i => data.push([i.tanggal, i.sumber_dana, i.jumlah]))
      var operation = 'Pemasukan '+'{{ Auth::user()->jamaah->masjid->name }}'
    @elseif(Request::routeIs('dashboard.pengeluaran'))
      var datapengeluaran = {!! json_encode(Auth::user()->jamaah->masjid->pengeluaran) !!}
      var data = [['Tanggal', 'Keterangan', 'Besar Dana']]
      datapengeluaran.map(i => data.push([i.tanggal, i.keterangan, i.jumlah]))
      var operation = 'Pengeluaran '+'{{ Auth::user()->jamaah->masjid->name }}'
    @endif

    document.getElementById("export-btn").addEventListener("click", function () {
      var wb = XLSX.utils.book_new();
      var ws = XLSX.utils.aoa_to_sheet(data);
      XLSX.utils.book_append_sheet(wb, ws);
      var wbout = XLSX.write(wb, { type: "binary", bookType: "xlsx" });
      function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
        return buf;
      }
      saveAs(
        new Blob([s2ab(wbout)], { type: "application/octet-stream" }),
        operation + ".xlsx"
      );
    });
  </script>
@endsection
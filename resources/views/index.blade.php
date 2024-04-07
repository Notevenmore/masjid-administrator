@extends('layouts.app')
@section('content')
  <div id="hero">
    <div class="hero-box">
        <div class="text-section">
            <div class="upper-text">
                <h4>Assalamualaikum,<br>
                    Selamat datang di @auth {{ Auth::user()->jamaah->masjid->name }}<br> {{ Auth::user()->jamaah->masjid->location }} @else @if(Request::routeIs('masjid.index')) Aplikasi Masjid administrator @elseif(Request::routeIs('masjid.show')) {{ $masjid->name }} @endif @endauth</h4>
            </div>
            <div class="lower-text">
              @auth
                <h4>Website ini merupakan media informasi dari untuk pengurus DKM mesjid <br> dan Jamaah {{ Auth::user()->jamaah->masjid->name }}, {{ Auth::user()->jamaah->masjid->location }}</h4>
              @else
                @if(Request::routeIs('masjid.index'))
                  <h4 style="font-size: 21px;">dengan menggunakan aplikasi ini, <br>diharapkan dapat memberikan informasi kepada anda seputar kegiatan mesjid. <br> Tidak hanya itu, jika anda mendaftar sebagai jamaah dari suatu masjid pada domisili anda, <br> anda dapat melihat info seputar dana masuk dan keluar dari masjid yang ada dilokasi yang anda kunjungi. <br> serta, sebagai pengurus anda dapat mengelola kegiatan, aset, serta pengelolaan dana dari masjid. <br><br> <a href="{{ route('auth.register') }}" class="action-btn" style="font-size: 21px;">Daftar sekarang</a></h4>
                @elseif(Request::routeIs('masjid.show'))
                  <h4>Halaman ini merupakan media informasi dari pengurus DKM mesjid <br> dan Jamaah {{ $masjid->name }}, {{ $masjid->location }}</h4>
                @endif
              @endauth
            </div>
        </div>
    </div>
  </div>
  <div id="report-info">
    @auth
      <div class="more-report-link">
          <a href="{{ route('laporankeuangan.index') }}">Lihat Laporan Keuangan</a>
          <img src="{{ asset('img/panahkanan.svg') }}" alt="">
      </div>
      <div class="report-content">
          <div class="pemasukkan">
              <div class="heading">
                  <div class="text-part">
                      <h3>Rekapitulasi Keuangan</h3>
                  </div>
                  <div class="input-part">
                      <form action="{{ route('jamaah.filteryear') }}" method="POST">
                        @csrf
                        <input type="date" name="before" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="sebelum" @if($start != null) value= {{ $start }} @endif>
                        <p style="display:flex;align-items: center;justify-content: center;margin-right: 7px;margin-left: 7px">Ke</p>
                        <input type="date" name="after" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="sesudah" @if($end != null) value={{ $end }} @endif>
                        <button type="submit" class="w-full text-white bg-green-700 
                        hover:bg-green-800 focus:ring-4 focus:outline-none 
                        focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700 
                        dark:focus:ring-blue-800" style="width: 300px;">Tampilkan</button>
                      </form>
                  </div>
              </div>
              <div class="graph">
                  <canvas id="bar-pemasukkan">
                  </canvas>
              </div>
          </div>
      </div>
    @else
      @if(Request::routeIs('masjid.index'))
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%;">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Nama Mesjid</th>
            <th scope="col" class="px-6 py-3">Lokasi</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($masjids as $masjid)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="px-6 py-4">{{ $masjid->name }}</td>
              <td class="px-6 py-4">{{ $masjid->location }}, Kecamatan {{ $masjid->subdistrict }}, {{ $masjid->cityorregency }}, {{ $masjid->province }}</td>
              <td class="px-6 py-4"><a href="{{ route('masjid.show', ['masjid' => $masjid]) }}" class="action-btn">Lihat selengkapnya..</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    @endauth
  </div>
  @auth
    <script>
      var dataPemasukan = {
            labels: [
              @foreach($rekapitulasi['tanggal'] as $rekap)
                '{{ $rekap }}',
              @endforeach
            ],
            datasets: [{
              label: "Pemasukkan Harian",
              data: [
                @foreach($rekapitulasi['total'] as $rekap)
                  {{ $rekap }},
                @endforeach
              ],
              backgroundColor: [
                '#05934A'
              ]
            }]
          };
    </script>
    <div id="more-info">
      <center>
          <div class="head-info">
              <h1>Informasi Kegiatan</h1>
              <br>
              <h4>Kegiatan - kegiatan yang akan dan telah dilaksanakan pada {{ Auth::user()->jamaah->masjid->name }} </h4>
          </div>
      </center>
      @if(count(Auth::user()->jamaah->masjid->informasikegiatan) == 0)
        <center style="font-weight: bolder; font-size: 20px;margin-top: 30px; margin-bottom: 30px;">Kegiatan belum ditambahkan oleh pengurus mesjid</center>
      @else
        @if(count(Auth::user()->jamaah->masjid->informasikegiatan) > 3)
          <div class="see-more-link">
              <a href="{{ route('informasikegiatan.index') }}">Lihat Lebih</a>
              <img src="{{ asset('img/panahkanan.svg') }}" alt="">  
          </div>
        @endif
        <div class="card-section">
            @foreach(Auth::user()->jamaah->masjid->informasikegiatan->take(3) as $fetch_data)
              <div class="card">
                @if($fetch_data->gambar != null)
                  <div class="image-card">
                    <img src="{{ asset('storage/'.$fetch_data->gambar) }}" alt="">
                  </div>
                @endif
                <div class="title-card p-2">
                  <h2>{{ $fetch_data->name }}</h2>
                </div>
                <div class="text-card p-2">
                  <p>{{ substr($fetch_data->deskripsi, 0, 100) }}...</p>
                </div>
                <div class="button-card">
                  <a href="{{ route('informasikegiatan.show', ['informasikegiatan' => $fetch_data]) }}"><button id="read-more-btn">Read More</button></a>
                </div>
              </div>
            @endforeach
          </div>
      @endif
    </div>
  @else
    @if(Request::routeIs('masjid.show'))
      <div id="more-info">
        <center>
            <div class="head-info">
                <h1>Informasi Kegiatan</h1>
                <br>
                <h4>Kegiatan - kegiatan yang akan dan telah dilaksanakan pada {{ $masjid->name }} </h4>
            </div>
        </center>
        @if(count($masjid->informasikegiatan) == 0)
          <center style="font-weight: bolder; font-size: 20px;margin-top: 30px; margin-bottom: 30px;">Kegiatan belum ditambahkan oleh pengurus mesjid</center>
        @else
          @if(count($masjid->informasikegiatan) > 3)
            <div class="see-more-link">
                <a href="{{ route('informasikegiatan.index') }}">Lihat Lebih</a>
                <img src="{{ asset('img/panahkanan.svg') }}" alt="">  
            </div>
          @endif
          <div class="card-section">
              @foreach($masjid->informasikegiatan->take(3) as $fetch_data)
                <div class="card">
                  @if($fetch_data->gambar != null)
                    <div class="image-card">
                      <img src="{{ asset('storage/'.$fetch_data->gambar) }}" alt="">
                    </div>
                  @endif
                  <div class="title-card p-2">
                    <h2>{{ $fetch_data->name }}</h2>
                  </div>
                  <div class="text-card p-2">
                    <p>{{ substr($fetch_data->deskripsi, 0, 100) }}...</p>
                  </div>
                  <div class="button-card">
                    <a href="{{ route('informasikegiatan.show', ['informasikegiatan' => $fetch_data]) }}"><button id="read-more-btn">Read More</button></a>
                  </div>
                </div>
              @endforeach
            </div>
        @endif
      </div>
    @endif
  @endauth
@endsection
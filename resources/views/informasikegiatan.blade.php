@extends('layouts.app')
@section('content')
  <div id="more-info">
    <div class="back-btn">
        <a href="{{ URL::previous() }}">
            <img src="{{ asset('img/panahkiri.svg') }}" alt="">
            <p>Kembali</p>
        </a>
    </div>
    @if(Request::routeIs('informasikegiatan.index'))
      <center>
          <div class="head-info">
              <h1>Informasi Kegiatan</h1>
              <br>
              <h4>Kegiatan - kegiatan yang akan dan telah dilaksanakan pada {{ Auth::user()->jamaah->masjid->name }}</h4>
          </div>
      </center>
      <div class="card-section">
        @foreach(Auth::user()->jamaah->masjid->informasikegiatan as $informasikegiatan)
          <div class="card">
            @if($informasikegiatan->gambar != null)
              <div class="image-card">
                <img src="{{ asset('storage/'.$informasikegiatan->gambar) }}" alt="">
              </div>
            @endif
            <div class="title-card p-2">
              <h2>{{ $informasikegiatan->name }}</h2>
            </div>
            <div class="text-card p-2">
              <p>{{ substr($informasikegiatan->deskripsi, 0, 100) }}...</p>
            </div>
            <div class="button-card">
              <a href="{{route('informasikegiatan.show', ['informasikegiatan' => $informasikegiatan])}}"><button id="read-more-btn">Read More</button></a>
            </div>
          </div>
        @endforeach         
      </div>
    @elseif(Request::routeIs('informasikegiatan.show'))
      <div class="head-info-kegiatan">
        <h1>{{ $informasikegiatan->name }}</h1>
        <br>
      </div>
      <div class="head-info-2">
          <div class="date">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2C5.73478 2 5.48043 2.10536 5.29289 2.29289C5.10536 2.48043 5 2.73478 5 3V4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V16C2 16.5304 2.21071 17.0391 2.58579 17.4142C2.96086 17.7893 3.46957 18 4 18H16C16.5304 18 17.0391 17.7893 17.4142 17.4142C17.7893 17.0391 18 16.5304 18 16V6C18 5.46957 17.7893 4.96086 17.4142 4.58579C17.0391 4.21071 16.5304 4 16 4H15V3C15 2.73478 14.8946 2.48043 14.7071 2.29289C14.5196 2.10536 14.2652 2 14 2C13.7348 2 13.4804 2.10536 13.2929 2.29289C13.1054 2.48043 13 2.73478 13 3V4H7V3C7 2.73478 6.89464 2.48043 6.70711 2.29289C6.51957 2.10536 6.26522 2 6 2ZM6 7C5.73478 7 5.48043 7.10536 5.29289 7.29289C5.10536 7.48043 5 7.73478 5 8C5 8.26522 5.10536 8.51957 5.29289 8.70711C5.48043 8.89464 5.73478 9 6 9H14C14.2652 9 14.5196 8.89464 14.7071 8.70711C14.8946 8.51957 15 8.26522 15 8C15 7.73478 14.8946 7.48043 14.7071 7.29289C14.5196 7.10536 14.2652 7 14 7H6Z" fill="#1F2A37" />
              </svg>
              <p>{{ $informasikegiatan->tanggal }}</p>
          </div>
          <div class="person">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10 9C10.7956 9 11.5587 8.68393 12.1213 8.12132C12.6839 7.55871 13 6.79565 13 6C13 5.20435 12.6839 4.44129 12.1213 3.87868C11.5587 3.31607 10.7956 3 10 3C9.20435 3 8.44129 3.31607 7.87868 3.87868C7.31607 4.44129 7 5.20435 7 6C7 6.79565 7.31607 7.55871 7.87868 8.12132C8.44129 8.68393 9.20435 9 10 9ZM3 18C3 17.0807 3.18106 16.1705 3.53284 15.3212C3.88463 14.4719 4.40024 13.7003 5.05025 13.0503C5.70026 12.4002 6.47194 11.8846 7.32122 11.5328C8.1705 11.1811 9.08075 11 10 11C10.9193 11 11.8295 11.1811 12.6788 11.5328C13.5281 11.8846 14.2997 12.4002 14.9497 13.0503C15.5998 13.7003 16.1154 14.4719 16.4672 15.3212C16.8189 16.1705 17 17.0807 17 18H3Z" fill="#1F2A37" />
              </svg>
              <p>{{ $informasikegiatan->penanggungjawab }}</p>
          </div>
          <div class="person">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
              <defs>
              </defs>
              <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                <path d="M 45 90 c -1.415 0 -2.725 -0.748 -3.444 -1.966 l -4.385 -7.417 C 28.167 65.396 19.664 51.02 16.759 45.189 c -2.112 -4.331 -3.175 -8.955 -3.175 -13.773 C 13.584 14.093 27.677 0 45 0 c 17.323 0 31.416 14.093 31.416 31.416 c 0 4.815 -1.063 9.438 -3.157 13.741 c -0.025 0.052 -0.053 0.104 -0.08 0.155 c -2.961 5.909 -11.41 20.193 -20.353 35.309 l -4.382 7.413 C 47.725 89.252 46.415 90 45 90 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: black; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                <path d="M 45 45.678 c -8.474 0 -15.369 -6.894 -15.369 -15.368 S 36.526 14.941 45 14.941 c 8.474 0 15.368 6.895 15.368 15.369 S 53.474 45.678 45 45.678 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
              </g>
              </svg>
              <p>{{ $informasikegiatan->alamat }}</p>
          </div>
      </div>
      <br><br>
      <div class="kegiatan-content">
          <div class="text-section">
              <p>
                 {{ $informasikegiatan->deskripsi }}
              </p>
          </div>
          @if($informasikegiatan->gambar != null)
            <div class="image-section">
                <img src="{{ asset('storage/'.$informasikegiatan->gambar) }}" alt="">
            </div>
          @endif
      </div>
    </div>
    @endif
  </div>
@endsection
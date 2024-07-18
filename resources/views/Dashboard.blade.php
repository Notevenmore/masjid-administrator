@extends('layouts.app')
@section('content')
@if(Request::routeIs('dashboard.index'))
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
      <div class="grid grid-cols-3 gap-4 mb-4">
        <h2 class="text-4xl font-bold dark:text-white">Dashboard</h2>
      </div>
      <div class="h-1 top-btn">
        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 
          focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 
          text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 
          dark:focus:ring-blue-800">
            <svg class="w-3 h-3 mr-1 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
            </svg>
          Bayar Kas
        </button>
      </div>
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
              <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Bayar Kas</h3>
              <form id="cashPaymentForm" class="space-y-6" action="{{ route('dashboard.cash-payment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                  <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal</label>
                  <input type="number" name="nominal" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Jumlah Dana">
                  @if($errors->has('nominal'))
                    <p style="font-size: 11px;color: red;margin-bottom: 10px;">{{ $errors->first('jumlah') }}</p>
                  @endif
                </div>
                <input type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              </form>
            </div>
          </div>
        </div>
      </div>
        <br>
      <div id="report-section">
        <div class="report-card">
          <div class="title">
            <h1>Pemasukkan</h1>
          </div>
          <div class="total">
            <p id="income">Rp{{ number_format(Auth::user()->jamaah->masjid->pemasukan->sum('jumlah')) }}</p>
          </div>
        </div>
        <div class="report-card">
          <div class="title">
            <h1>Pengeluaran</h1>
          </div>
          <div class="total">
            <p id="outcome">- Rp{{ number_format(Auth::user()->jamaah->masjid->pengeluaran->sum('jumlah')) }}</p>
          </div>
        </div>
        <div class="report-card">
          <div class="title">
            <h1>Saldo</h1>
          </div>
          <div class="total">
            <p id="balance">Rp{{ number_format(Auth::user()->jamaah->masjid->pemasukan->sum('jumlah') - Auth::user()->jamaah->masjid->pengeluaran->sum('jumlah')) }}</p>
          </div>
        </div>
      </div>
      <div id="report-info">
        <div class="report-content" style="margin-top: 30px;">
          <div class="perbandingan">
            <div class="heading">
              <div class="text-part">
                <h3>Pemasukan</h3>
              </div>
            </div>
            <div class="graph">
              <canvas id="bar-pemasukan"></canvas>
            </div>
          </div>
          <div class="perbandingan">
            <div class="heading">
              <div class="text-part">
                <h3>Pengeluaran</h3>
              </div>
            </div>
            <div class="graph">
              <canvas id="bar-pengeluaran"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div id="report-info">
        <div class="report-content" style="margin-top: 30px;">
          <div class="perbandingan">
            <div class="heading">
              <div class="text-part">
                <h3>Rekapitulasi</h3>
              </div>
            </div>
            <div class="graph">
              <canvas id="bar-rekapitulasi"></canvas>
            </div>
          </div>
        </div>
      </div>
      {{-- kas --}}
      <div class="pie-chart">
        <div id="report-info">
        </div>
      </div>
    </div>
    <script>
      const url = "{{ route('dashboard.cash-payment') }}"
      const urlafter = "{{ route('dashboard.thanks') }}"
      var pemasukan = @json($pemasukan);
      var pengeluaran = @json($pengeluaran);
      var rekapitulasi = @json($rekapitulasi);
      var recapKas = @json($jamaahPaideds);
      var countJamaah = {{ $banyakJamaah }};
    </script>
    <script src="{{ asset('js/cashPayment.js') }}"></script>
    <script src="{{ asset('js/randomColor.js') }}"></script>
  </div>
@elseif(Request::routeIs('master.index'))
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
      <div class="grid grid-cols-3 gap-4 mb-4">
        <h2 class="text-4xl font-bold dark:text-white">Dashboard</h2>
      </div>
      <br>
      <div id="report-section">
        <div class="report-card">
          <div class="title">
            <h1>User</h1>
          </div>
          <div class="total">
            <p id="income">{{ count($users) }}</p>
          </div>
        </div>
        <div class="report-card">
          <div class="title">
            <h1>Masjid</h1>
          </div>
          <div class="total">
            <p id="income">{{ count($masjids) }}</p>
          </div>
        </div>
      </div>
      <div id="report-info">
        <div class="report-content">
          <div class="pemasukkan">
            <div class="heading">
              <div class="text-part">
                <h3>Masjid</h3>
              </div>
            </div>
            <div class="graph">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%;">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Ketua DKM</th>
                    <th scope="col" class="px-6 py-3">Admin</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($masjids as $masjid)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <td class="px-6 py-4">{{ $i++ }}</td>
                      <td class="px-6 py-4">{{ $masjid->name }}</td>
                      <td class="px-6 py-4">
                        @foreach($masjid->jamaah as $jamaah)
                          @if($jamaah->user->admin->status && $jamaah->user->admin->role == 'Ketua DKM')
                            {{ $jamaah->user->name }}
                          @endif
                        @endforeach
                      </td>
                      <td class="px-6 py-4">
                        @foreach($masjid->jamaah as $jamaah)
                          @if($jamaah->user->admin->status && $jamaah->user->admin->role == 'admin')
                            {{ $jamaah->user->name }}
                          @endif
                        @endforeach
                      </td>
                      <td class="px-6 py-4">{{ $masjid->location }}, Kecamatan {{ $masjid->subdistrict }}, {{ $masjid->cityorregency }}, {{ $masjid->province }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="perbandingan">
            <div class="heading">
              <div class="text-part">
                <h3>User</h3>
              </div>
            </div>
            @if(Request::session()->has('success'))
              <div class="bg-success">
                <p>{{ Request::session()->get('success') }}</p>
              </div>
            @endif
            <div class="graph">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%;">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Jamaah</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <td class="px-6 py-4">{{ $j++ }}</td>
                      <td class="px-6 py-4">{{ $user->name }}</td>
                      <td class="px-6 py-4">{{ $user->jamaah->masjid->name }}</td>
                      <td class="px-6 py-4">
                        <form action="{{ route('user-master.update', ['user' => $user]) }}" method="post">
                          @csrf
                          @method('PUT')
                          <label for="admin">Admin</label>
                          <input type="checkbox" name="admin" id="admin" value="admin" @if($user->admin->status && $user->admin->role == 'admin') checked @endif>
                          <br>
                          <label for="master">Master</label>
                          <input type="checkbox" name="master" id="master" value="master" @if($user->master->status) checked @endif>
                          <br>
                          <button type="submit" class="action-btn">Edit</button>
                        </form>
                      </td>
                      <td class="px-6 py-4">
                        <form action="{{ route('user-master.destroy', ['user' => $user]) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="action-btn" onclick="return confirm('Yakin hapus data ini ?') ">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
@endsection
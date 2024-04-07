@extends('layouts.app')
@section('content')
@if(Request::routeIs('dashboard.index'))
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
      <div class="grid grid-cols-3 gap-4 mb-4">
        <h2 class="text-4xl font-bold dark:text-white">Dashboard</h2>
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
        <div class="report-content">
          <div class="pemasukkan">
            <div class="heading">
              <div class="text-part">
                <h3>Pemasukkan</h3>
              </div>
            </div>
            <div class="graph">
              <canvas id="bar-pemasukkan"></canvas>
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
    </div>
    <script>
          var dataPemasukan = {
            labels: [
              @foreach(Auth::user()->jamaah->masjid->pemasukan()->orderBy('tanggal', "asc")->get() as $pemasukan)
                '{{ $pemasukan->tanggal }}',
              @endforeach
            ],
            datasets: [{
              label: "Pemasukkan Harian",
              data: [
                @foreach(Auth::user()->jamaah->masjid->pemasukan()->orderBy('tanggal', "asc")->get() as $pemasukan)
                  {{ $pemasukan->jumlah }},
                @endforeach
              ],
              backgroundColor: [
                '#05934A'
              ]
            }]
          };

          var dataPengeluaran = {
            labels: [
              @foreach(Auth::user()->jamaah->masjid->pengeluaran()->orderBy('tanggal', "asc")->get() as $pengeluaran)
                '{{ $pengeluaran->tanggal }}',
              @endforeach
            ],
            datasets: [{
              label: "Pengeluaran Harian",
              data: [
                @foreach(Auth::user()->jamaah->masjid->pengeluaran()->orderBy('tanggal', "asc")->get() as $pengeluaran)
                  {{ $pengeluaran->jumlah }},
                @endforeach
              ],
              backgroundColor: [
                '#05934A'
              ]
            }]
          };

          var dataRekapitulasi = {
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
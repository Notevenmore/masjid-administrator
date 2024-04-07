@extends('layouts.app')

@section('content')
  <div class="@if(Request::routeIs('dashboard.laporan')) p-4 sm:ml-64 @endif" id="@if(Request::routeIs('laporankeuangan.index')) laporan-info @endif">
    @if(Request::routeIs('laporankeuangan.index'))
    <div class="back-btn">
        <a href="{{ route('jamaah.index') }}" style="margin-top: 30px;">
            <img src="{{ asset('img/panahkiri.svg') }}" alt="">
            <p>Kembali</p>
        </a>
    </div>
    @endif
      <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14" @if(Request::routeIs('laporankeuangan.index')) style="margin: 0px 60px;" @endif>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <h2 class="text-4xl font-bold dark:text-white">{{ $title }}</h2>
            <br><br>
        </div>
        <form action="@if(Request::routeIs('dashboard.laporan')) {{ route('dashboard.laporan') }} @elseif(Request::routeIs('laporankeuangan.index')) {{ route('laporankeuangan.index') }} @endif" method="POST">
            @csrf
            <div class="grid gap-4 lg:grid-cols-3 lg:gap-6">
                <div class="w-full">
                    <div date-rangepicker class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                            focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                            dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mulai Tanggal" value="{{ $start }}">
                        </div>
                        <span class="mx-4 text-gray-500">Ke</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                            focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                            dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Hingga Tanggal" value="{{ $end }}">
                        </div>
                        <div class="relative mx-4">
                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 
                        focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                        inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 btn">Filter</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <br><br>
        <div class="@if(Request::routeIs('laporankeuangan.index')) @endif">
            <div class="mb-5 overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%;">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Penanggung Jawab
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pemasukan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pengeluaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Saldo
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->jamaah->masjid->laporankeuangan()->table()->filter($start, $end)->get() as $laporankeuangan)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $no++ }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $laporankeuangan->pemasukan == null ? $laporankeuangan->pengeluaran->tanggal : $laporankeuangan->pemasukan->tanggal }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $laporankeuangan->pemasukan == null ? $laporankeuangan->pengeluaran->keterangan : $laporankeuangan->pemasukan->sumber_dana }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $laporankeuangan->admin->user->name }}
                                    </td>
                                    @if($laporankeuangan->pemasukan != null)
                                        <td class="px-6 py-4 text-teal-600">
                                            {{ $laporankeuangan->pemasukan->jumlah }}
                                        </td>
                                        <td></td>
                                        <td class="px-6 py-4 text-blue-600">
                                            <?php
                                            $masuk += $laporankeuangan->pemasukan->jumlah;
                                            $saldo += $laporankeuangan->pemasukan->jumlah;
                                            echo $saldo;
                                            ?>
                                        </td>
                                    @elseif($laporankeuangan->pengeluaran != null)
                                        <td></td>
                                        <td class="px-6 py-4 text-red-600">
                                            -{{ $laporankeuangan->pengeluaran->jumlah }}
                                        </td>
                                        <td class="px-6 py-4 text-blue-600">
                                            <?php
                                            $keluar -= $laporankeuangan->pengeluaran->jumlah;
                                            $saldo -= $laporankeuangan->pengeluaran->jumlah;
                                            echo $saldo;
                                            ?>
                                        </td>
                                    @endif
                                </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-semibold text-gray-900 dark:text-white">
                            <th scope="row" class="px-6 py-3 text-base">Total</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="px-6 py-3 text-teal-600">{{ $masuk }}</td>
                            <td class="px-6 py-3 text-red-600">{{ $keluar }}</td>
                            <td class="px-6 py-3 text-blue-600">{{ $saldo }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <br><br>
  </div>
@endsection
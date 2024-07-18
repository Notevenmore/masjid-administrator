<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>{{ $title }}</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="icon" href="{{ asset('img/masjid.png') }}">
      
      @auth
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @if(Request::routeIs('dashboard.index'))
          <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
          <script src="{{ asset('js/jquery.js') }}"></script>
        @endif
        @if(Request::routeIs(['dashboard.index', 'dashboard.pemasukan', 'dashboard.pengeluaran', 'dashboard.laporan', 'dashboard.asset_mesjid', 'dashboard.kegiatan','dashboard.kelola', 'pemasukan.edit', 'pengeluaran.edit', 'aset.edit', 'informasikegiatan.create', 'informasikegiatan.edit', 'master.index']))
          <link rel="stylesheet" href="{{ asset('css/style-admin.css') }}">
        @else
          <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        @endif

        @if(Request::routeIs(['dashboard.pemasukan', 'dashboard.pengeluaran']))
          <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
        @endif
      @else
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        @if(Request::routeIs(['auth.login', 'auth.register', 'auth.register-jamaah', 'auth.register-admin']))
          <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
        @else
          <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
          <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
          <link rel="stylesheet" href="{{ asset('css/style.css') }}">
          <link rel="stylesheet" href="{{ asset('css/style-admin.css') }}">
        @endif
      @endauth
      
      <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  </head>

  <body id="{{ $bodyId }}">
    @if(Request::routeIs(['jamaah.index','jamaah.filteryear', 'informasikegiatan.index', 'informasikegiatan.show', 'laporankeuangan.index', 'masjid.index', 'masjid.show']))
      <div id="navbar">
        <div class="logo">
          @auth
            <a href="{{ route('jamaah.index') }}" style="display:flex; align-items: center; justify-content: center; gap: 10px;">
                <img src="{{ asset('img/logo-small.jpg') }}" alt="" style="width: 50px; height: 50px;">
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">{{ Auth::user()->jamaah->masjid->name }}</span>
            </a>
          @else
            <a href="{{ route('masjid.index') }}" style="display:flex; align-items: center; justify-content: center; gap: 10px;">
                <img src="{{ asset('img/logo-small.jpg') }}" alt="" style="width: 50px; height: 50px;">
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Masjid Administrator</span>
            </a>
          @endauth
        </div>
        <div class="button">
          @auth
            @if(!Auth::user()->admin->status && !Auth::user()->master->status)
              <a href="{{ route('auth.logout') }}"><button id="login-btn">Logout</button></a>
            @else
              <div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="{{ asset('img/masjid.png') }}" alt="user photo">
                </button>
              </div>
              <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                <div class="px-4 py-3" role="none">
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{ Auth::user()->name }}
                  </p>
                  @if(Auth::user()->admin->status)
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                      {{ Auth::user()->admin->role }}
                    </p>
                  @endif
                  @if(Auth::user()->master->status)
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    Master
                  </p>
                  @endif
                </div>
                <ul class="py-1" role="none">
                  @if(Auth::user()->admin->status)
                    <li>
                      <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                    </li>
                  @endif
                  @if(Auth::user()->master->status)
                    <li>
                      <a href="{{ route('master.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard Master</a>
                    </li>    
                  @endif
                  <li>
                    <a href="{{ route('auth.logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Logout</a>
                  </li>
                </ul>
              </div>
            @endif
          @else
            <a href="{{ route('auth.login') }}"><button id="login-btn">Login</button></a>
          @endauth
        </div>
      </div>
      <hr>
    @elseif(Request::routeIs(['dashboard.index', 'dashboard.pemasukan', 'dashboard.pengeluaran', 'dashboard.laporan', 'dashboard.asset_mesjid', 'dashboard.kegiatan', 'dashboard.kelola' ,'pemasukan.edit', 'pengeluaran.edit', 'aset.edit', 'informasikegiatan.create', 'informasikegiatan.edit', 'master.index']))
      <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
          <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
              <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
              </button>
              <a href="{{ route('dashboard.index') }}" class="flex ml-2 md:mr-24">
                <img src="{{ asset('img/logo-small.jpg') }}" class="h-8 mr-3" alt="FlowBite Logo" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">{{ Auth::user()->jamaah->masjid->name }}</span>
              </a>
            </div>
            <div class="flex items-center" style="gap: 1em; align-items:center;">
              <div class="flex items-center ml-3">
                <div>
                  <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                  </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                  <div class="px-4 py-3" role="none">
                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                      {{ Auth::user()->name }}
                    </p>
                    @if(Auth::user()->admin->status)
                      <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                        {{ Auth::user()->admin->role }}
                      </p>
                    @endif
                    @if(Auth::user()->master->status)
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                      Master
                    </p>
                    @endif
                  </div>
                  <ul class="py-1" role="none">
                    @if(Auth::user()->admin->status)
                      <li>
                        <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                      </li>
                    @endif
                    @if(Auth::user()->master->status)
                      <li>
                        <a href="{{ route('master.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard Master</a>
                      </li>    
                    @endif
                    <li>
                      <a href="{{ route('jamaah.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Home</a>
                    </li>
                    <li>
                      <a href="{{ route('auth.logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Logout</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div id="separator">
                <img src="img/separator.png" alt="" style="width: 1px;height: 43px;">
              </div>
              <div class="logout-btn">
                <a href="{{ route('auth.logout') }}">
                  <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Log Out</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
           <ul class="space-y-2 font-medium">
              <li>
                 <a href="{{ route('dashboard.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white @if(Request::routeIs('dashboard.index')) bg-gray-100 @endif hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                       <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                       <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="flex-1 whitespace-nowrap ml-3">Dashboard</span>
                 </a>
              </li>
              @if(Auth::user()->admin->role == 'Bendahara' || Auth::user()->admin->role == 'Ketua DKM')
                <li>
                  <a href="{{ route('dashboard.pemasukan') }}" class="@if(Request::routeIs('dashboard.pemasukan')) bg-gray-100 @endif  flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                      <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                        <path d="M14.067 0H7v5a2 2 0 0 1-2 2H0v4h7.414l-1.06-1.061a1 1 0 1 1 1.414-1.414l2.768 2.768a1 1 0 0 1 0 1.414l-2.768 2.768a1 1 0 0 1-1.414-1.414L7.414 13H0v5a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.933-2Z" />
                      </svg>
                      <span class="flex-1 ml-3 whitespace-nowrap">Pemasukkan</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('dashboard.pengeluaran') }}" class="@if(Request::routeIs('dashboard.pengeluaran')) bg-gray-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                      <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11.074 4 8.442.408A.95.95 0 0 0 7.014.254L2.926 4h8.148ZM9 13v-1a4 4 0 0 1 4-4h6V6a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1v-2h-6a4 4 0 0 1-4-4Z" />
                        <path d="M19 10h-6a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1Zm-4.5 3.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM12.62 4h2.78L12.539.41a1.086 1.086 0 1 0-1.7 1.352L12.62 4Z" />
                      </svg>
                      <span class="flex-1 ml-3 whitespace-nowrap">Pengeluaran</span>
                  </a>
                </li>
              @endif
              <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                @if(Auth::user()->admin->role == 'Pengurus DKM' || Auth::user()->admin->role == 'Ketua DKM')
                  <li>
                      <a href="{{ route('dashboard.laporan') }}" class="@if(Request::routeIs('dashboard.laporan')) bg-gray-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v2H7V2ZM5 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 4H8a1 1 0 0 1 0-2h5a1 1 0 0 1 0 2Zm0-4H8a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Laporan</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('dashboard.asset_mesjid') }}" class="@if(Request::routeIs('dashboard.asset_mesjid')) bg-gray-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Aset Masjid</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('dashboard.kegiatan') }}" class="@if(Request::routeIs('dashboard.kegiatan')) bg-gray-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 21">
                            <path d="m5.4 2.736 3.429 3.429A5.046 5.046 0 0 1 10.134 6c.356.01.71.06 1.056.147l3.41-3.412c.136-.133.287-.248.45-.344A9.889 9.889 0 0 0 10.269 1c-1.87-.041-3.713.44-5.322 1.392a2.3 2.3 0 0 1 .454.344Zm11.45 1.54-.126-.127a.5.5 0 0 0-.706 0l-2.932 2.932c.029.023.049.054.078.077.236.194.454.41.65.645.034.038.078.067.11.107l2.927-2.927a.5.5 0 0 0 0-.707Zm-2.931 9.81c-.024.03-.057.052-.081.082a4.963 4.963 0 0 1-.633.639c-.041.036-.072.083-.115.117l2.927 2.927a.5.5 0 0 0 .707 0l.127-.127a.5.5 0 0 0 0-.707l-2.932-2.931Zm-1.442-4.763a3.036 3.036 0 0 0-1.383-1.1l-.012-.007a2.955 2.955 0 0 0-1-.213H10a2.964 2.964 0 0 0-2.122.893c-.285.29-.509.634-.657 1.013l-.01.016a2.96 2.96 0 0 0-.21 1 2.99 2.99 0 0 0 .489 1.716c.009.014.022.026.032.04a3.04 3.04 0 0 0 1.384 1.1l.012.007c.318.129.657.2 1 .213.392.015.784-.05 1.15-.192.012-.005.02-.013.033-.018a3.011 3.011 0 0 0 1.676-1.7v-.007a2.89 2.89 0 0 0 0-2.207 2.868 2.868 0 0 0-.27-.515c-.007-.012-.02-.025-.03-.039Zm6.137-3.373a2.53 2.53 0 0 1-.35.447L14.84 9.823c.112.428.166.869.16 1.311-.01.356-.06.709-.147 1.054l3.413 3.412c.132.134.249.283.347.444A9.88 9.88 0 0 0 20 11.269a9.912 9.912 0 0 0-1.386-5.319ZM14.6 19.264l-3.421-3.421c-.385.1-.781.152-1.18.157h-.134c-.356-.01-.71-.06-1.056-.147l-3.41 3.412a2.503 2.503 0 0 1-.443.347A9.884 9.884 0 0 0 9.732 21H10a9.9 9.9 0 0 0 5.044-1.388 2.519 2.519 0 0 1-.444-.348ZM1.735 15.6l3.426-3.426a4.608 4.608 0 0 1-.013-2.367L1.735 6.4a2.507 2.507 0 0 1-.35-.447 9.889 9.889 0 0 0 0 10.1c.1-.164.217-.316.35-.453Zm5.101-.758a4.957 4.957 0 0 1-.651-.645c-.033-.038-.077-.067-.11-.107L3.15 17.017a.5.5 0 0 0 0 .707l.127.127a.5.5 0 0 0 .706 0l2.932-2.933c-.03-.018-.05-.053-.078-.076ZM6.08 7.914c.03-.037.07-.063.1-.1.183-.22.384-.423.6-.609.047-.04.082-.092.129-.13L3.983 4.149a.5.5 0 0 0-.707 0l-.127.127a.5.5 0 0 0 0 .707L6.08 7.914Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Informasi Kegiatan</span>
                      </a>
                  </li>
                @endif
                @if(Auth::user()->admin->role == 'admin' || Auth::user()->admin->role == 'Ketua DKM')
                 <li>
                    <a href="{{ route('dashboard.kelola') }}" class="@if(Request::routeIs('dashboard.kelola')) bg-gray-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                      <svg class="w-5 h-5 text-gray-500 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                        <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                        <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                    </svg>
                       <span class="flex-1 ml-3 whitespace-nowrap">Kelola Jamaah</span>
                    </a>
                 </li>
                @endif
              </ul>
        </div>
     </aside>
    @endif  
    @yield('content')
    @if(Request::routeIs(['jamaah.index', 'jamaah.filteryear' ,'informasikegiatan.index', 'informasikegiatan.show', 'laporankeuangan.index', 'masjid.index', 'masjid.show']))
      <div id="footer">
        <div class="title">
            <h1>CONTACT</h1>
        </div>
        <div class="content">
            <div class="text-content">
                <p>Jalan Teuku Nyak Arief, Simprug</p>
            </div>
            <div class="text-content">
                <p>Kebayoran Lama, Jakarta 12220</p>
            </div>
            <div class="text-content">
                <p>Telp +6285162784180</p>
            </div>
            <div class="text-content">
                <p>Email : abdamadhafiz13@gmail.com</p>
            </div>
        </div>
        <div class="break-line">
            <hr>
        </div>
        <div class="additional-info">
            <p>Design with love by Computer Science, Pertamina University Student. All Rights reserved</p>
        </div>
      </div>
    @endif
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
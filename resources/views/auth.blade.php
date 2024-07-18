@extends('layouts.app')
@section('content')
<div class="logo" style="display: flex; flex-direction: row; gap: 10px; font-size: 11px; align-items: center; margin-bottom: 10px">
  <img src="{{ asset('img/logo-small.jpg') }}" alt="" style="width: 70px; height: 70px;">
  <h1>Masjid Administrator</h1>
</div>
<div class="login-container">
  <h2>{{ $title }}</h2>
  @if(Request::session()->has('success'))
      <p class="register-success">{{ Request::session()->get('success') }}</p>
  @endif
  @if(Request::routeIs('auth.register'))
  <div class="d-flex">
    <a href="{{ route('auth.register-jamaah') }}" class="btn" style="text-decoration: none;">Register sebagai jamaah</a>
    <a href="{{ route('auth.register-admin') }}" class="btn" style="text-decoration: none;">Register sebagai admin</a>
    <a href="{{ route('auth.login') }}">Kembali ke halaman login?</a>
  </div>
  @else
    <form action="{{ route($action) }}" method="POST">
      @csrf
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="email">
        @error('email')
          <p class="login-failed">{{ $message }}</p>
        @enderror
      </div>
      @if(!Request::routeIs('auth.login'))
        <div class="form-group">
          <input type="tel" id="email" name="telp" placeholder="Nomor Telpon" pattern="^(\+62|62|0)8[1-9][0-9]{6,9}$">
          @error('telp')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
      @endif
      @if(Request::routeIs('auth.register-jamaah'))
        <div class="form-group">
          <input type="text" id="name" name="name" placeholder="name">
          @error('name')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <select name="masjid" id="masjid">
            <option selected disabled>--Domisili--</option>
            @foreach($masjids as $masjid)
              <option value="{{ $masjid->id }}">{{ $masjid->name }}-{{ $masjid->location }},Kec.{{ $masjid->subdistict }}, Kab.{{ $masjid->cityorregency }}, {{ $masjid->province }}</option>
            @endforeach
          </select>
          @error('masjid')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
      @elseif(Request::routeIs('auth.register-admin'))
        <div class="form-group">
          <input type="text" id="name" name="adminname" placeholder="Nama Admin">
          @error('adminname')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <input type="text" id="" name="mosquename" placeholder="Nama Mesjid: Masjid Asy-Syukur">
          @error('mosquename')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <input type="text" id="" name="location" placeholder="Alamat: Jalan Jendral Sudirman No.3A">
          @error('location')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <input type="text" id="" name="subdistrict" placeholder="Kecamatan: Kebayoran Lama">
          @error('subdistrict')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <input type="text" id="" name="city" placeholder="Kabupaten: Jakarta Selatan">
          @error('city')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <input type="text" id="" name="province" placeholder="Provinsi: Daerah Khusus Ibukota Jakarta">
          @error('province')
            <p class="login-failed">{{ $message }}</p>
          @enderror
        </div>
      @endif
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="password">
        @error('password')
          <p class="login-failed">{{ $message }}</p>
        @enderror
      </div>
      @if(Request::session()->has('failed'))
        <p class="login-failed">{{ Request::session()->get('failed') }}</p>
      @endif
      <p>{{ $ready }} membuat akun? lakukan <a href="{{ route($linknext) }}">{{ $go_action }}</a> sekarang</p>
      <button type="submit">{{ $title }}</button>
    </form>
  @endif
</div>
@endsection
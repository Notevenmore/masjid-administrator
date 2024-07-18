@extends('layouts.app')
@section('content')
<div style="width: 100vw; height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center;">
  <h1 style="font-weight: bolder; font-size: 100px;">Pembayaran berhasil dilakukan</h1>
  <h2 style="font-weight: bolder; font-size: 100px;">Terima Kasih</h2>
</div>
<script>
  setTimeout(() => {
    window.location.href = "{{ route('dashboard.index') }}";
  }, 5000)
</script>
@endsection
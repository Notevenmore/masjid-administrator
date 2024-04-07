@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
  <div class="p-4 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <div class="grid grid-cols-3 gap-4 my-7">
      <h2 class="text-4xl font-bold dark:text-white">{{ $title }}</h2>
    </div>
    @if(Request::session()->has('success'))
      <div class="bg-success">
        <p>{{ Request::session()->get('success') }}</p>
      </div>
    @endif
    <div class="h-24 mb-4 ">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 text-center" style="width: 100%;">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="px-6 py-3">
                          Username
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Role
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Edit Role
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Remove
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach(Auth::user()->jamaah->masjid->jamaah as $jamaah)
                          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  {{ $jamaah->user->name }}
                              </th>
                              <td class="px-6 py-4" style="font-weight: bolder;">
                                  @if(!$jamaah->user->admin->status)
                                    Jamaah
                                  @else
                                    {{ $jamaah->user->admin->role }}
                                  @endif
                              </td>
                              <td>
                                  <form action="{{ route('user.update', ['user' => $jamaah->user]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <label for="jamaah">Jamaah</label>
                                    <input type="radio" id="jamaah" name="role" value="jamaah" @if(!$jamaah->user->admin->status) checked @endif>
                                    <label for="KetuaDKM" style="margin-left: 10px;">Ketua DKM</label>
                                    <input type="radio" id="KetuaDKM" name="role" value="Ketua DKM" @if($jamaah->user->admin->role == 'Ketua DKM') checked @endif>
                                    <label for="PengurusDKM" style="margin-left: 10px;">Pengurus DKM</label>
                                    <input type="radio" id="PengurusDKM" name="role" value="Pengurus DKM" @if($jamaah->user->admin->role == 'Pengurus DKM') checked @endif>
                                    <label for="Bendahara" style="margin-left: 10px;">Bendahara</label>
                                    <input type="radio" id="Bendahara" name="role" value="Bendahara" @if($jamaah->user->admin->role == 'Bendahara') checked @endif>
                                    <label for="Admin" style="margin-left: 10px;">Admin</label>
                                    <input type="radio" id="Admin" name="role" value="admin" @if($jamaah->user->admin->role == 'admin') checked @endif>
                                    <button type="submit" class="action-btn">Edit</button>
                                </form>
                                </td>
                              <td class="px-6 py-4 text-left">
                                <form action="{{ route('user.destroy', ['user' => $jamaah->user]) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="action-btn" onclick="return confirm('Yakin hapus data ini ?') ">Remove</button>
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
@endsection
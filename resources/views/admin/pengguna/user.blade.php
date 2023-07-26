<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="  sm:flex grid  bg-blue-300 gap-2 sm:grid-cols-1">
        <div>
          <form action="/create-user" method="post">
            @csrf
            <button class=" hover:bg-blue-900 bg-blue-600 px-2 py-1 w-full text-white capitalize">buat Akun Mahasiswa</button>
          </form>
        </div>
        <div>
          <form action="/data-user" method="post">
            @csrf
            <button class=" hover:bg-blue-900 bg-blue-600 px-2 py-1 w-full text-white capitalize">buat Akun Dosen</button>
          </form>
        </div>
        <div class=" py-1">
          <a href="" class=" hover:bg-blue-900 bg-blue-600 px-2 py-1 w-full text-white capitalize">Tambah Role</a>
        </div>
      </div>
    </div>
    <div class="p-4 mt-2 bg-white  border-gray-200">
      <div>
        <div>
          <!-- Tambahkan kode berikut di dalam halaman home.blade.php -->
          @if(Session::has('success'))
          <div class="alert alert-success">
            {{ Session::get('success') }}
          </div>
          @endif
          @if(Session::has('info'))
          <div class="alert alert-info">
            {{ Session::get('info') }}
          </div>
          @endif
        </div>
        <div class=" overflow-auto">
          <table class=" w-fit  sm:w-full">
            <thead>
              <tr>
                <th class=" border">No</th>
                <th class=" border">Nama</th>
                <th class=" border">Email</th>
              </tr>
            </thead>
            <tbody>
              @foreach($AdminUser as $user)
              <tr>
                <td class=" px-1 border text-center">{{ $loop->iteration }}</td>
                <td class=" px-1 border capitalize">{{ strtolower($user->name) }}</td>
                <td class=" px-1 border text-center">{{ $user->email }}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan=" 3" class=" text-xs py-1">
                  {{$AdminUser}}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class=" py-1">

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
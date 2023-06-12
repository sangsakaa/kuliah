<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="  flex bg-blue-300">
        <div>
          <form action="/create-user" method="post">
            @csrf
            <button class=" hover:bg-blue-900 bg-blue-600 px-2 py-1 text-white capitalize">buat Akun Mahasiswa</button>
          </form>
        </div>
        <div>
          <form action="/create-user-dosen" method="post">
            @csrf
            <button class=" hover:bg-blue-900 bg-blue-600 px-2 py-1 text-white capitalize">buat Akun Dosen</button>
          </form>
        </div>
      </div>
    </div>
    <div class="p-4 mt-2 bg-white  border-gray-200">
      <div>
        <table class=" w-full">
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

              <td class=" border text-center">{{ $loop->iteration }}</td>
              <td class=" border">{{ $user->name }}</td>
              <td class=" border text-center">{{ $user->email }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class=" py-1">
          {{$AdminUser}}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>